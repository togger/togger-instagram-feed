<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap tif-admin-wrap">
    <h1 class="wp-heading-inline">
        <span class="dashicons dashicons-instagram"></span>
        Togger Instagram Feed Einstellungen
    </h1>
    
    <hr class="wp-header-end">

    <!-- Setup Tutorial -->
    <div class="tif-card tif-tutorial">
        <details>
            <summary style="cursor: pointer; font-size: 1.3em; font-weight: 600; padding: 10px 0;">📖 Schritt-für-Schritt Anleitung</summary>
        
        <div class="tif-tutorial-steps">
            <div class="tif-step">
                <div class="tif-step-number">1</div>
                <div class="tif-step-content">
                    <h3>Facebook Developer Account erstellen</h3>
                    <p><strong>Option A - Direkter Zugriff:</strong><br>
                    Gehe zu <a href="https://developers.facebook.com" target="_blank">developers.facebook.com</a> und melde dich mit deinem Facebook-Account an.</p>
                    
                    <p><strong>Option B - Über Business Manager (wenn kein Zugriff):</strong><br>
                    Falls du die Meldung "You don't have access" erhältst, nutze stattdessen:<br>
                    1. Gehe zu <a href="https://business.facebook.com" target="_blank">business.facebook.com</a><br>
                    2. Klicke auf <strong>Business Settings</strong> (Zahnrad-Symbol)<br>
                    3. Unter <strong>Accounts</strong> → <strong>Apps</strong><br>
                    4. Klicke auf <strong>Add</strong> → <strong>Create New App ID</strong></p>
                    
                    <details style="margin-top: 10px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 5px;">
                        <summary style="cursor: pointer; font-weight: 600;">❓ Warum habe ich keinen Zugriff auf developers.facebook.com?</summary>
                        <ul style="margin-top: 10px;">
                            <li><strong>Neuer Account:</strong> Sehr neue Facebook-Accounts haben manchmal eingeschränkten Zugriff</li>
                            <li><strong>Fehlende Verifizierung:</strong> Stelle sicher, dass E-Mail und Telefonnummer verifiziert sind</li>
                            <li><strong>Business Manager erforderlich:</strong> Manche Organisationen erfordern Zugriff über Business Manager</li>
                            <li><strong>Browser-Problem:</strong> Versuche Incognito-Modus oder lösche Cache/Cookies</li>
                            <li><strong>VPN:</strong> Deaktiviere VPN falls aktiv</li>
                        </ul>
                    </details>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">2</div>
                <div class="tif-step-content">
                    <h3>Neue App erstellen</h3>
                    <ol>
                        <li>Klicke auf "Create App" / "App erstellen"</li>
                        <li>Wähle "Business" als App-Typ</li>
                        <li>Gib einen App-Namen ein (z.B. "Literaturhaus Instagram Feed")</li>
                        <li>Wähle "Yourself or your own business" als Zweck</li>
                        <li>Klicke auf "Create App"</li>
                    </ol>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">3</div>
                <div class="tif-step-content">
                    <h3>Instagram Basic Display API hinzufügen</h3>
                    <ol>
                        <li>Im App Dashboard, suche nach "Instagram Basic Display"</li>
                        <li>Klicke auf "Set Up" / "Einrichten"</li>
                        <li>Scrolle nach unten zu "User Token Generator"</li>
                        <li>Klicke auf "Add or Remove Instagram Testers"</li>
                        <li>Füge deinen Instagram Business Account hinzu</li>
                    </ol>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">4</div>
                <div class="tif-step-content">
                    <h3>Facebook Login hinzufügen</h3>
                    <ol>
                        <li>Gehe zurück zum App Dashboard</li>
                        <li>Suche "Facebook Login" und klicke auf "Set Up"</li>
                        <li>Wähle "Web" als Platform</li>
                        <li>Kopiere die Redirect URI unten und füge sie unter "Valid OAuth Redirect URIs" ein</li>
                        <li>Speichern nicht vergessen!</li>
                    </ol>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">5</div>
                <div class="tif-step-content">
                    <h3>App ID und Secret kopieren</h3>
                    <ol>
                        <li>Gehe zu "Settings" → "Basic" in deiner App</li>
                        <li>Kopiere die "App ID" und "App Secret"</li>
                        <li>Füge beide in die Felder unten ein</li>
                        <li>Klicke auf "Einstellungen speichern"</li>
                    </ol>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">6</div>
                <div class="tif-step-content">
                    <h3>Instagram Business Account vorbereiten</h3>
                    <p><strong>Wichtig:</strong> Dein Instagram Account muss ein <strong>Business Account</strong> sein und mit einer Facebook-Seite verbunden sein!</p>
                    <ol>
                        <li>Öffne Instagram → Einstellungen → Account</li>
                        <li>Wechsle zu "Professional Account" (falls noch nicht geschehen)</li>
                        <li>Verbinde mit deiner Facebook-Seite unter "Page"</li>
                    </ol>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">7</div>
                <div class="tif-step-content">
                    <h3>Mit Facebook verbinden</h3>
                    <p>Klicke auf den Button "Mit Facebook verbinden" unten, um die Autorisierung abzuschließen.</p>
                </div>
            </div>
        </div>

        <div class="tif-tutorial-note">
            <strong>💡 Hinweis:</strong> Der Access Token ist 60 Tage gültig. Du musst ihn danach erneuern.
        </div>
        </details>
    </div>

    <!-- Redirect URI Card -->
    <div class="tif-card">
        <h2>🔗 Redirect URI (OAuth Callback URL)</h2>
        <p class="description">Diese URL musst du in den Facebook App-Einstellungen unter <strong>Facebook Login → Settings → Valid OAuth Redirect URIs</strong> eintragen:</p>
        <div class="tif-copy-field">
            <input type="text" value="<?php echo esc_url($data['redirect_uri']); ?>" readonly onclick="this.select();">
            <button type="button" class="button" onclick="navigator.clipboard.writeText('<?php echo esc_js($data['redirect_uri']); ?>'); alert('In Zwischenablage kopiert!');">
                📋 Kopieren
            </button>
        </div>
    </div>

    <!-- App Settings Form -->
    <form method="POST" class="tif-card">
        <?php wp_nonce_field('tif_save_settings'); ?>
        <h2>🔑 Facebook App Zugangsdaten</h2>
        <p class="description">Diese Daten findest du in deiner Facebook App unter Settings → Basic</p>
        
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="tif_app_id">App ID</label>
                </th>
                <td>
                    <input type="text" 
                           id="tif_app_id" 
                           name="tif_app_id" 
                           value="<?php echo esc_attr($data['app_id']); ?>" 
                           class="regular-text"
                           placeholder="1234567890123456">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="tif_app_secret">App Secret</label>
                </th>
                <td>
                    <input type="password" 
                           id="tif_app_secret" 
                           name="tif_app_secret" 
                           value="<?php echo esc_attr($data['app_secret']); ?>" 
                           class="regular-text"
                           placeholder="********************************">
                    <p class="description">Klicke auf "Show" in den Facebook-Einstellungen, um das Secret zu sehen.</p>
                </td>
            </tr>
        </table>
        
        <p class="submit">
            <input type="submit" name="tif_save_settings" class="button button-primary" value="Einstellungen speichern">
        </p>
    </form>

    <!-- Connection Card -->
    <div class="tif-card">
        <h2>🔐 Instagram Verbindung</h2>
        
        <?php if (!empty($data['app_id']) && !empty($data['app_secret'])): ?>
            <?php if ($data['is_connected']): ?>
                <div class="tif-status-connected">
                    <span class="dashicons dashicons-yes-alt"></span>
                    <strong>Erfolgreich verbunden!</strong>
                </div>
                
                <?php if (!empty($data['instagram_username'])): ?>
                    <p>Instagram Account: <strong>@<?php echo esc_html($data['instagram_username']); ?></strong></p>
                <?php endif; ?>

                <form method="POST" style="display: inline-block; margin-right: 10px;">
                    <?php wp_nonce_field('tif_refresh_token'); ?>
                    <button type="submit" name="tif_refresh_token" class="button button-secondary">
                        🔄 Token aktualisieren
                    </button>
                </form>
                
                <a href="<?php echo esc_url($this->getFacebookLoginUrl()); ?>" class="button button-secondary">
                    🔗 Erneut verbinden
                </a>
            <?php else: ?>
                <p>Klicke auf den Button, um dein Instagram Business Account zu verbinden:</p>
                <a href="<?php echo esc_url($this->getFacebookLoginUrl()); ?>" class="button button-primary button-hero">
                    Mit Facebook verbinden
                </a>
            <?php endif; ?>
        <?php else: ?>
            <div class="tif-status-error">
                <span class="dashicons dashicons-warning"></span>
                <strong>Bitte zuerst App ID und App Secret speichern!</strong>
            </div>
        <?php endif; ?>
    </div>

    <!-- Status Card -->
    <div class="tif-card">
        <h2>📊 Status</h2>
        
        <table class="tif-status-table">
            <tr>
                <td class="tif-status-label">Facebook App ID</td>
                <td class="tif-status-value">
                    <?php if (!empty($data['app_id'])): ?>
                        <span class="tif-status-ok">✅ Konfiguriert</span>
                    <?php else: ?>
                        <span class="tif-status-error">❌ Nicht konfiguriert</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tif-status-label">Access Token</td>
                <td class="tif-status-value">
                    <?php if (!empty($data['long_lived_token'])): ?>
                        <span class="tif-status-ok">✅ Vorhanden (Long-Lived)</span>
                        <?php if ($data['token_expires'] > 0): ?>
                            <br><small>Läuft ab: <?php echo date('d.m.Y H:i', $data['token_expires']); ?></small>
                            <?php if ($data['token_expires'] < time() + (7 * DAY_IN_SECONDS)): ?>
                                <br><span style="color: #d63638;">⚠️ Token läuft bald ab! Bitte erneuern.</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="tif-status-error">❌ Nicht vorhanden</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tif-status-label">Instagram Business Account</td>
                <td class="tif-status-value">
                    <?php if (!empty($data['instagram_account_id'])): ?>
                        <span class="tif-status-ok">✅ Verbunden</span>
                        <br><small>ID: <?php echo esc_html($data['instagram_account_id']); ?></small>
                    <?php else: ?>
                        <span class="tif-status-error">❌ Nicht verbunden</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tif-status-label">Cache Status</td>
                <td class="tif-status-value">
                    <?php if ($data['cache_active']): ?>
                        <span class="tif-status-ok">✅ Aktiv</span>
                        <form method="POST" style="display: inline-block; margin-left: 10px;">
                            <?php wp_nonce_field('tif_clear_cache'); ?>
                            <button type="submit" name="tif_clear_cache" class="button button-small">Cache leeren</button>
                        </form>
                    <?php else: ?>
                        <span class="tif-status-warning">⚪ Kein Cache</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

    <!-- ACF Options Card -->
    <div class="tif-card">
        <h2>⚙️ ACF Konfiguration</h2>
        <?php if (function_exists('acf_add_local_field_group')): ?>
            <?php $instagram_acf = get_field('instagram', 'option'); ?>
            <table class="tif-status-table">
                <tr>
                    <td class="tif-status-label">Überschrift</td>
                    <td class="tif-status-value">
                        <?php if (!empty($instagram_acf['headline'])): ?>
                            <span class="tif-status-ok">✅ <?php echo esc_html($instagram_acf['headline']); ?></span>
                        <?php else: ?>
                            <span class="tif-status-warning">⚪ Nicht gesetzt</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="tif-status-label">Benutzername</td>
                    <td class="tif-status-value">
                        <?php if (!empty($instagram_acf['username'])): ?>
                            <span class="tif-status-ok">✅ <?php echo esc_html($instagram_acf['username']); ?></span>
                        <?php else: ?>
                            <span class="tif-status-warning">⚪ Nicht gesetzt</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="tif-status-label">Profil-Link</td>
                    <td class="tif-status-value">
                        <?php if (!empty($instagram_acf['profile-link'])): ?>
                            <span class="tif-status-ok">✅ <?php echo esc_html($instagram_acf['profile-link']); ?></span>
                        <?php else: ?>
                            <span class="tif-status-warning">⚪ Nicht gesetzt</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <p style="margin-top: 12px;">
                <a href="<?php echo esc_url(admin_url('admin.php?page=tif-acf-options')); ?>" class="button button-secondary">
                    ✏️ Konfiguration bearbeiten
                </a>
            </p>
        <?php else: ?>
            <div class="tif-status-error">
                <span class="dashicons dashicons-warning"></span>
                <strong>Advanced Custom Fields (ACF) ist nicht aktiviert.</strong><br>
                <small>Bitte installiere und aktiviere das ACF-Plugin, um diese Funktion zu nutzen.</small>
            </div>
        <?php endif; ?>
    </div>

    <!-- Shortcode Usage -->
    <?php if ($data['is_connected']): ?>
    <div class="tif-card">
        <h2>🎨 Verwendung im Frontend</h2>
        <p>Füge diesen Shortcode in einen Beitrag oder eine Seite ein, um den Instagram Feed anzuzeigen:</p>
        
        <div class="tif-copy-field">
            <input type="text" value="[togger_instagram_feed limit=&quot;12&quot; columns=&quot;3&quot;]" readonly onclick="this.select();">
            <button type="button" class="button" onclick="navigator.clipboard.writeText('[togger_instagram_feed limit=&quot;12&quot; columns=&quot;3&quot;]'); alert('Shortcode kopiert!');">
                📋 Kopieren
            </button>
        </div>
        
        <h3>Optionen:</h3>
        <ul>
            <li><code>limit</code> - Anzahl der Posts (Standard: 12)</li>
            <li><code>columns</code> - Anzahl der Spalten im Grid (Standard: 3)</li>
        </ul>
        
        <h3>Beispiele:</h3>
        <ul>
            <li><code>[togger_instagram_feed]</code> - Standard (12 Posts, 3 Spalten)</li>
            <li><code>[togger_instagram_feed limit="6"]</code> - 6 Posts</li>
            <li><code>[togger_instagram_feed limit="9" columns="3"]</code> - 9 Posts in 3 Spalten</li>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Troubleshooting -->
    <div class="tif-card tif-troubleshooting">
        <h2>🔧 Problemlösung</h2>
        
        <details>
            <summary><strong>Fehler: "You don't have access" bei developers.facebook.com</strong></summary>
            <p><strong>Mögliche Ursachen und Lösungen:</strong></p>
            <ol>
                <li><strong>Neuer Facebook-Account:</strong> Dein Account muss eine gewisse Zeit aktiv sein und verifiziert sein (E-Mail + Telefon)</li>
                <li><strong>Fehlende Verifizierung:</strong> Gehe zu Facebook → Einstellungen → Sicherheit und verifiziere E-Mail und Telefonnummer</li>
                <li><strong>Business Manager erforderlich:</strong> Nutze stattdessen business.facebook.com → Business Settings → Accounts → Apps</li>
                <li><strong>Browser-Cache:</strong> Lösche Browser-Cache und Cookies (Strg+Shift+Entf) oder nutze Incognito-Modus</li>
                <li><strong>VPN/Proxy:</strong> Deaktiviere VPN oder Proxy und versuche es erneut</li>
                <li><strong>Konto-Einschränkungen:</strong> Prüfe auf facebook.com/support ob dein Account eingeschränkt ist</li>
                <li><strong>Anderer Browser:</strong> Versuche es mit Chrome, Firefox oder Edge</li>
            </ol>
            <p><strong>Alternative:</strong> Erstelle die App über business.facebook.com statt über developers.facebook.com</p>
        </details>

        <details>
            <summary><strong>Fehler: "Kein Instagram Business Account gefunden"</strong></summary>
            <p>Dein Instagram Account muss:</p>
            <ul>
                <li>Ein <strong>Business</strong> oder <strong>Creator Account</strong> sein (kein privater Account)</li>
                <li>Mit einer <strong>Facebook-Seite</strong> verbunden sein</li>
            </ul>
            <p>Überprüfe dies in der Instagram App unter: Einstellungen → Account → Switch to Professional Account</p>
        </details>

        <details>
            <summary><strong>Fehler: "Invalid OAuth Redirect URI"</strong></summary>
            <p>Die Redirect URI wurde nicht korrekt in den Facebook App-Einstellungen eingetragen.</p>
            <p>Gehe zu: Facebook App → Products → Facebook Login → Settings → Valid OAuth Redirect URIs</p>
            <p>Füge die oben angezeigte Redirect URI ein und speichere.</p>
        </details>

        <details>
            <summary><strong>Fehler: "Token expired"</strong></summary>
            <p>Der Access Token ist abgelaufen (nach 60 Tagen). Klicke auf "Token aktualisieren" oder verbinde dich erneut.</p>
        </details>

        <details>
            <summary><strong>Keine Posts werden angezeigt</strong></summary>
            <ul>
                <li>Stelle sicher, dass dein Instagram Account öffentliche Posts hat</li>
                <li>Leere den Cache mit dem "Cache leeren" Button</li>
                <li>Überprüfe, ob die Instagram Account ID korrekt ist</li>
            </ul>
        </details>

        <details>
            <summary><strong>App muss in den "Live Mode"</strong></summary>
            <p>Für die Produktion muss deine Facebook App in den Live-Modus wechseln:</p>
            <ol>
                <li>Gehe zu deiner Facebook App</li>
                <li>Klicke oben rechts auf den Toggle-Switch (aktuell "Development")</li>
                <li>Wähle "Switch to Live"</li>
                <li>Akzeptiere die Bedingungen</li>
            </ol>
        </details>
    </div>

    <!-- Footer Links -->
    <div class="tif-card tif-footer-links">
        <h3>📚 Nützliche Links</h3>
        <ul>
            <li><a href="https://developers.facebook.com/apps/" target="_blank">Facebook Developer Dashboard</a></li>
            <li><a href="https://developers.facebook.com/docs/instagram-basic-display-api" target="_blank">Instagram Basic Display API Dokumentation</a></li>
            <li><a href="https://developers.facebook.com/docs/facebook-login/" target="_blank">Facebook Login Dokumentation</a></li>
            <li><a href="https://business.facebook.com/" target="_blank">Facebook Business Manager</a></li>
        </ul>
    </div>
</div>
