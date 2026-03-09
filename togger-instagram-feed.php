<?php
/**
 * Plugin Name: Togger Instagram Feed
 * Description: Instagram Feed Plugin mit Facebook Graph API Integration - Verbesserte Version mit vollständiger Anleitung
 * Version: 2.0
 * Author: Togger
 * Text Domain: togger-instagram-feed
 */

if (!defined('ABSPATH')) {
    exit;
}

class ToggersInstagramFeed
{
    private static $instance = null;
    const CACHE_KEY = 'tif_instagram_posts_cache';
    const CACHE_DURATION = DAY_IN_SECONDS;

    private function __construct()
    {
        register_activation_hook(__FILE__, [$this, 'onActivate']);
        register_deactivation_hook(__FILE__, [$this, 'onDeactivate']);
        
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('admin_init', [$this, 'handleSettingsSave']);
        add_action('admin_init', [$this, 'handleOAuthCallback']);
        add_action('admin_init', [$this, 'handleCacheClear']);
        add_action('admin_init', [$this, 'handleTokenRefresh']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdminStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueFrontendStyles']);
        add_action('acf/init', [$this, 'registerAcfOptionsPage']);
        add_action('acf/init', [$this, 'registerAcfFieldGroup']);
        add_action('tif_auto_refresh_token', [$this, 'maybeAutoRefreshToken']);
        add_action('init', [$this, 'maybeScheduleCron']);
        
        // Shortcode registration
        add_shortcode('togger_instagram_feed', [$this, 'renderShortcode']);
    }

    public static function getInstance(): ToggersInstagramFeed
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function onActivate()
    {
        add_option('tif_app_id', '');
        add_option('tif_app_secret', '');
        add_option('tif_access_token', '');
        add_option('tif_long_lived_token', '');
        add_option('tif_token_expires', 0);
        add_option('tif_instagram_account_id', '');
        add_option('tif_facebook_page_id', '');
        add_option('tif_instagram_username', '');

        if (!wp_next_scheduled('tif_auto_refresh_token')) {
            wp_schedule_event(time(), 'daily', 'tif_auto_refresh_token');
        }
    }

    public function onDeactivate()
    {
        delete_option('tif_app_id');
        delete_option('tif_app_secret');
        delete_option('tif_access_token');
        delete_option('tif_long_lived_token');
        delete_option('tif_token_expires');
        delete_option('tif_instagram_account_id');
        delete_option('tif_facebook_page_id');
        delete_option('tif_instagram_username');
        delete_transient(self::CACHE_KEY);

        $timestamp = wp_next_scheduled('tif_auto_refresh_token');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'tif_auto_refresh_token');
        }
    }

    public function enqueueAdminStyles($hook)
    {
        if ($hook !== 'toplevel_page_tif-settings') {
            return;
        }
        
        wp_enqueue_style('tif-admin-styles', plugins_url('assets/admin-style.css', __FILE__));
    }

    public function enqueueFrontendStyles()
    {
        wp_enqueue_style(
            'tif-frontend-styles',
            plugins_url('assets/frontend-style.css', __FILE__),
            [],
            '1.0.0'
        );
    }

    public function registerAcfOptionsPage(): void
    {
        if (!function_exists('acf_add_options_sub_page')) {
            return;
        }

        acf_add_options_sub_page([
            'page_title'  => 'Instagram Konfiguration',
            'menu_title'  => 'Konfiguration',
            'parent_slug' => 'tif-settings',
            'capability'  => 'manage_options',
            'menu_slug'   => 'tif-acf-options',
        ]);
    }

    public function registerAcfFieldGroup(): void
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group([
            'key'    => 'group_tif_instagram',
            'title'  => 'Instagram Feed',
            'fields' => [
                [
                    'key'        => 'field_tif_instagram',
                    'label'      => 'Instagram',
                    'name'       => 'instagram',
                    'type'       => 'group',
                    'layout'     => 'block',
                    'sub_fields' => [
                        [
                            'key'           => 'field_tif_instagram_headline',
                            'label'         => 'Überschrift',
                            'name'          => 'headline',
                            'type'          => 'text',
                            'default_value' => 'Instagram',
                            'placeholder'   => 'Instagram',
                        ],
                        [
                            'key'         => 'field_tif_instagram_username',
                            'label'       => 'Benutzername',
                            'name'        => 'username',
                            'type'        => 'text',
                            'instructions'=> 'Anzeigename, z.B. @kinderuni_at',
                            'placeholder' => '@username',
                        ],
                        [
                            'key'         => 'field_tif_instagram_profile_link',
                            'label'       => 'Profil-Link',
                            'name'        => 'profile-link',
                            'type'        => 'url',
                            'instructions'=> 'URL zum Instagram-Profil',
                            'placeholder' => 'https://www.instagram.com/kinderuni_at',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param'    => 'options_page',
                        'operator' => '==',
                        'value'    => 'tif-acf-options',
                    ],
                ],
            ],
        ]);
    }

    public function addAdminMenu()
    {
        add_menu_page(
            'Togger Instagram Feed',
            'Instagram Feed',
            'manage_options',
            'tif-settings',
            [$this, 'renderSettingsPage'],
            'dashicons-instagram',
            90
        );
    }

    public function handleSettingsSave()
    {
        if (!isset($_POST['tif_save_settings']) || !current_user_can('manage_options')) {
            return;
        }

        check_admin_referer('tif_save_settings');

        update_option('tif_app_id', sanitize_text_field($_POST['tif_app_id']));
        update_option('tif_app_secret', sanitize_text_field($_POST['tif_app_secret']));

        add_settings_error(
            'tif_messages',
            'tif_message',
            'Einstellungen erfolgreich gespeichert.',
            'success'
        );
    }

    public function handleOAuthCallback()
    {
        if (!isset($_GET['page']) || $_GET['page'] !== 'tif-settings') {
            return;
        }

        if (isset($_GET['code'])) {
            $this->exchangeCodeForToken($_GET['code']);
        }

        if (isset($_GET['error'])) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'OAuth-Fehler: ' . sanitize_text_field($_GET['error_description'] ?? $_GET['error']),
                'error'
            );
        }
    }

    public function handleCacheClear()
    {
        if (!isset($_POST['tif_clear_cache']) || !current_user_can('manage_options')) {
            return;
        }

        check_admin_referer('tif_clear_cache');
        delete_transient(self::CACHE_KEY);

        add_settings_error(
            'tif_messages',
            'tif_message',
            'Cache erfolgreich geleert.',
            'success'
        );
    }

    public function handleTokenRefresh()
    {
        if (!isset($_POST['tif_refresh_token']) || !current_user_can('manage_options')) {
            return;
        }

        check_admin_referer('tif_refresh_token');
        $this->refreshLongLivedToken();
    }

    public function renderSettingsPage()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        settings_errors('tif_messages');

        $data = [
            'app_id' => get_option('tif_app_id'),
            'app_secret' => get_option('tif_app_secret'),
            'access_token' => get_option('tif_access_token'),
            'long_lived_token' => get_option('tif_long_lived_token'),
            'token_expires' => get_option('tif_token_expires'),
            'instagram_account_id' => get_option('tif_instagram_account_id'),
            'facebook_page_id' => get_option('tif_facebook_page_id'),
            'instagram_username' => get_option('tif_instagram_username'),
            'redirect_uri' => admin_url('admin.php?page=tif-settings'),
            'is_connected' => !empty(get_option('tif_long_lived_token')),
            'cache_active' => get_transient(self::CACHE_KEY) !== false,
        ];

        include plugin_dir_path(__FILE__) . 'views/admin-settings.php';
    }

    public function getFacebookLoginUrl(): string
    {
        $appId = get_option('tif_app_id');
        $redirectUri = urlencode(admin_url('admin.php?page=tif-settings'));
        $permissions = [
            'instagram_basic',
            'instagram_content_publish',
            'pages_show_list',
            'pages_read_engagement',
            'business_management'
        ];

        return "https://www.facebook.com/v21.0/dialog/oauth?"
            . "client_id={$appId}&"
            . "redirect_uri={$redirectUri}&"
            . "scope=" . implode(',', $permissions) . "&"
            . "response_type=code";
    }

    private function exchangeCodeForToken(string $code)
    {
        $appId = get_option('tif_app_id');
        $appSecret = get_option('tif_app_secret');
        $redirectUri = admin_url('admin.php?page=tif-settings');

        if (empty($appId) || empty($appSecret)) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'App ID oder App Secret fehlt.',
                'error'
            );
            return;
        }

        // Step 1: Exchange code for short-lived token
        $url = "https://graph.facebook.com/v21.0/oauth/access_token?" . http_build_query([
            'client_id' => $appId,
            'redirect_uri' => $redirectUri,
            'client_secret' => $appSecret,
            'code' => $code,
        ]);

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Fehler beim Abrufen des Access Tokens: ' . $response->get_error_message(),
                'error'
            );
            return;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);
        
        if (!isset($data['access_token'])) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Kein Access Token erhalten: ' . (isset($data['error']['message']) ? $data['error']['message'] : 'Unbekannter Fehler'),
                'error'
            );
            return;
        }

        $shortLivedToken = $data['access_token'];
        update_option('tif_access_token', $shortLivedToken);

        // Step 2: Exchange for long-lived token
        $this->exchangeForLongLivedToken($shortLivedToken);

        // Step 3: Get Facebook Page and Instagram Account
        $this->fetchFacebookPageAndInstagramAccount();
    }

    private function exchangeForLongLivedToken(string $shortLivedToken)
    {
        $appId = get_option('tif_app_id');
        $appSecret = get_option('tif_app_secret');

        $url = "https://graph.facebook.com/v21.0/oauth/access_token?" . http_build_query([
            'grant_type' => 'fb_exchange_token',
            'client_id' => $appId,
            'client_secret' => $appSecret,
            'fb_exchange_token' => $shortLivedToken,
        ]);

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Fehler beim Abrufen des Long-Lived Tokens: ' . $response->get_error_message(),
                'error'
            );
            return;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($data['access_token'])) {
            update_option('tif_long_lived_token', $data['access_token']);
            
            // Calculate expiry time (60 days)
            $expiresIn = isset($data['expires_in']) ? (int)$data['expires_in'] : 5184000; // 60 days default
            update_option('tif_token_expires', time() + $expiresIn);

            add_settings_error(
                'tif_messages',
                'tif_message',
                'Long-Lived Access Token erfolgreich gespeichert (gültig für 60 Tage).',
                'success'
            );
        }
    }

    private function fetchFacebookPageAndInstagramAccount()
    {
        $accessToken = get_option('tif_long_lived_token') ?: get_option('tif_access_token');

        if (empty($accessToken)) {
            return;
        }

        // Get Facebook Pages
        $url = "https://graph.facebook.com/v21.0/me/accounts?access_token=" . urlencode($accessToken);
        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Fehler beim Abrufen der Facebook-Seiten: ' . $response->get_error_message(),
                'error'
            );
            return;
        }

        $pageData = json_decode(wp_remote_retrieve_body($response), true);

        if (!isset($pageData['data']) || empty($pageData['data'])) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Keine Facebook-Seite gefunden. Stelle sicher, dass dein Account eine Facebook-Seite verwaltet.',
                'error'
            );
            return;
        }

        // Use first page
        $pageId = $pageData['data'][0]['id'];
        $pageAccessToken = $pageData['data'][0]['access_token'];
        
        update_option('tif_facebook_page_id', $pageId);
        update_option('tif_long_lived_token', $pageAccessToken); // Use page access token

        // Get Instagram Business Account
        $url = "https://graph.facebook.com/v21.0/{$pageId}?fields=instagram_business_account&access_token=" . urlencode($pageAccessToken);
        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Fehler beim Abrufen des Instagram-Accounts: ' . $response->get_error_message(),
                'error'
            );
            return;
        }

        $instagramData = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($instagramData['instagram_business_account']['id'])) {
            $instagramAccountId = $instagramData['instagram_business_account']['id'];
            update_option('tif_instagram_account_id', $instagramAccountId);

            // Get Instagram username
            $url = "https://graph.facebook.com/v21.0/{$instagramAccountId}?fields=username&access_token=" . urlencode($pageAccessToken);
            $response = wp_remote_get($url);
            
            if (!is_wp_error($response)) {
                $usernameData = json_decode(wp_remote_retrieve_body($response), true);
                if (isset($usernameData['username'])) {
                    update_option('tif_instagram_username', $usernameData['username']);
                }
            }

            add_settings_error(
                'tif_messages',
                'tif_message',
                'Instagram Business Account erfolgreich verbunden!',
                'success'
            );
        } else {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Kein Instagram Business Account mit dieser Facebook-Seite verbunden. Bitte verbinde einen Instagram Business Account mit deiner Facebook-Seite.',
                'error'
            );
        }
    }

    private function refreshLongLivedToken()
    {
        $currentToken = get_option('tif_long_lived_token');
        
        if (empty($currentToken)) {
            add_settings_error(
                'tif_messages',
                'tif_message',
                'Kein Token zum Aktualisieren vorhanden.',
                'error'
            );
            return;
        }

        $this->exchangeForLongLivedToken($currentToken);
    }

    public function maybeAutoRefreshToken(): void
    {
        $expires    = (int) get_option('tif_token_expires', 0);
        $token      = get_option('tif_long_lived_token');

        if (empty($token) || $expires === 0) {
            return;
        }

        // Refresh when fewer than 7 days remain
        if ($expires - time() < 7 * DAY_IN_SECONDS) {
            $this->exchangeForLongLivedToken($token);
        }
    }

    public function maybeScheduleCron(): void
    {
        if (!wp_next_scheduled('tif_auto_refresh_token')) {
            wp_schedule_event(time(), 'daily', 'tif_auto_refresh_token');
        }
    }

    public function getInstagramPosts(int $limit = 12): array
    {
        $accessToken = get_option('tif_long_lived_token');
        $instagramAccountId = get_option('tif_instagram_account_id');

        if (empty($accessToken) || empty($instagramAccountId)) {
            return ['error' => 'Plugin nicht konfiguriert. Bitte Instagram-Account in den Einstellungen verbinden.'];
        }

        // Check cache
        $cachedPosts = get_transient(self::CACHE_KEY);
        if ($cachedPosts !== false) {
            return array_slice($cachedPosts, 0, $limit);
        }

        // Fetch from API
        $fields = 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp,username';
        $url = "https://graph.facebook.com/v21.0/{$instagramAccountId}/media?" . http_build_query([
            'fields' => $fields,
            'limit' => $limit,
            'access_token' => $accessToken,
        ]);

        $response = wp_remote_get($url);

        if (is_wp_error($response)) {
            return ['error' => 'Fehler beim Abrufen der Instagram-Posts: ' . $response->get_error_message()];
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($data['error'])) {
            $errorMsg = $data['error']['message'] ?? 'Unbekannter API-Fehler';
            
            // Check if token expired
            if ($data['error']['code'] === 190) {
                update_option('tif_token_expires', 0);
                $errorMsg .= ' - Bitte Token in den Plugin-Einstellungen erneuern.';
            }
            
            return ['error' => $errorMsg];
        }

        if (isset($data['data'])) {
            set_transient(self::CACHE_KEY, $data['data'], self::CACHE_DURATION);
            return $data['data'];
        }

        return ['error' => 'Keine Posts gefunden.'];
    }

    public function renderShortcode($atts)
    {
        $atts = shortcode_atts([
            'limit' => 12,
            'columns' => 3,
        ], $atts);

        $posts = $this->getInstagramPosts((int)$atts['limit']);

        if (isset($posts['error'])) {
            return '<div class="tif-error">' . esc_html($posts['error']) . '</div>';
        }

        $template = locate_template('togger-instagram-feed/feed-template.php');
        if (empty($template)) {
            $template = plugin_dir_path(__FILE__) . 'views/feed-template.php';
        }

        ob_start();
        include $template;
        return ob_get_clean();
    }
}

// Initialize plugin
ToggersInstagramFeed::getInstance();
