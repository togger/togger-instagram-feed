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
                    <h3>Instagram Business Account vorbereiten</h3>
                    <p><strong>Voraussetzung:</strong> Dein Instagram Account muss ein <strong>Business</strong> oder <strong>Creator Account</strong> sein und mit einer <strong>Facebook-Seite verknüpft</strong> sein. Ohne diese Verbindung kann das Plugin keinen Zugriff erhalten.</p>
                    <ol>
                        <li>Öffne Instagram (App) → Einstellungen &amp; Aktivitäten → Account → <strong>Zu Professional Account wechseln</strong></li>
                        <li>Wähle „Business" als Account-Typ</li>
                        <li>Verknüpfe den Account mit deiner Facebook-Seite: Instagram → Einstellungen → Account → <strong>Mit Facebook verknüpfen</strong></li>
                    </ol>
                    <p style="margin-top: 8px;"><strong>Wichtig:</strong> Du musst <strong>Admin der Facebook-Seite</strong> sein, die mit Instagram verknüpft ist.</p>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">2</div>
                <div class="tif-step-content">
                    <h3>Meta Developer App erstellen</h3>
                    <p>Zuerst bei <a href="https://www.facebook.com" target="_blank">facebook.com</a> einloggen, dann <a href="https://developers.facebook.com" target="_blank">developers.facebook.com</a> öffnen.</p>
                    <ol>
                        <li>Klicke auf <strong>„My Apps"</strong> → <strong>„Create App"</strong></li>
                        <li>Use Case: <strong>„Other"</strong> → <strong>„Next"</strong></li>
                        <li>App-Typ: <strong>„Business"</strong> → <strong>„Next"</strong></li>
                        <li>App-Namen eingeben (z.B. „Literaturhaus Instagram Feed") → <strong>„Create App"</strong></li>
                    </ol>
                    <details style="margin-top: 10px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 5px;">
                        <summary style="cursor: pointer; font-weight: 600;">❓ „Dieses Feature ist noch nicht für dich verfügbar."?</summary>
                        <p style="margin-top: 8px;">Diese Meldung bedeutet, dass dein Facebook-Account noch nicht als Entwickler-Account freigeschaltet ist. Der häufigste Grund ist eine fehlende Telefon-Verifizierung:</p>
                        <ol style="margin-top: 6px;">
                            <li>Gehe zu <a href="https://accountscenter.facebook.com/personal_info/contact_points" target="_blank">accountscenter.facebook.com</a> (Meta Account Center)</li>
                            <li>Klicke auf <strong>„Kontaktinfos"</strong> → <strong>„Telefonnummer"</strong> → Nummer hinzufügen und verifizieren</li>
                            <li><a href="https://developers.facebook.com" target="_blank">developers.facebook.com</a> neu laden – „Create App" sollte jetzt erscheinen</li>
                        </ol>
                        <p style="margin-top: 6px;">Falls das nicht hilft: Prüfe ob dein Account Einschränkungen hat unter <a href="https://www.facebook.com/help/contact/260749603972907" target="_blank">facebook.com/support</a>.</p>
                    </details>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">3</div>
                <div class="tif-step-content">
                    <h3>„Facebook Login for Business" zur App hinzufügen</h3>
                    <p><strong>Hinweis:</strong> Die frühere <em>Instagram Basic Display API</em> wurde von Meta <strong>im Dezember 2024 abgeschafft</strong>. Dieses Plugin verwendet stattdessen die <strong>Graph API über Facebook Login</strong>.</p>
                    <ol>
                        <li>Im App Dashboard: links unter <strong>„Add Product"</strong> (oder „Use Cases") → suche <strong>„Facebook Login for Business"</strong> → Klicke <strong>„Set Up"</strong></li>
                        <li>Wähle <strong>„Web"</strong> als Platform</li>
                        <li>Kopiere die <strong>Redirect URI</strong> aus dem Feld unten auf dieser Seite</li>
                        <li>Füge sie unter <strong>Facebook Login → Settings → Valid OAuth Redirect URIs</strong> ein</li>
                        <li>Klicke <strong>„Save Changes"</strong></li>
                    </ol>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">4</div>
                <div class="tif-step-content">
                    <h3>App ID und App Secret kopieren</h3>
                    <ol>
                        <li>Im App Dashboard: links auf <strong>„App settings"</strong> → <strong>„Basic"</strong></li>
                        <li>Kopiere <strong>„App ID"</strong> und klicke bei „App Secret" auf <strong>„Show"</strong></li>
                        <li>Füge beide Werte in die Felder unten auf dieser Seite ein</li>
                        <li>Klicke <strong>„Einstellungen speichern"</strong></li>
                    </ol>
                </div>
            </div>

            <div class="tif-step">
                <div class="tif-step-number">5</div>
                <div class="tif-step-content">
                    <h3>Mit Facebook verbinden</h3>
                    <p>Klicke auf den Button <strong>„Mit Facebook verbinden"</strong> weiter unten.</p>
                    <p>Du wirst zu Facebook weitergeleitet und musst den Zugriff auf deine <strong>Facebook-Seite</strong> und den damit verknüpften <strong>Instagram Business Account</strong> erlauben.</p>
                    <p>Das Plugin holt danach automatisch die nötigen IDs und speichert den Access Token (gültig für 60 Tage).</p>
                </div>
            </div>

        </div>

        <div class="tif-tutorial-note">
            <strong>💡 Hinweis:</strong> Der Access Token ist 60 Tage gültig und wird automatisch täglich erneuert, solange er noch aktiv ist.
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
                        <?php endif; ?>                        <?php $next_refresh = wp_next_scheduled('tif_auto_refresh_token'); ?>
                        <?php if ($next_refresh): ?>
                            <br><small>🔄 Nächste automatische Erneuerung: <?php echo date('d.m.Y H:i', $next_refresh); ?></small>
                        <?php endif; ?>                    <?php else: ?>
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
            <summary><strong>Fehler: „Dieses Feature ist noch nicht für dich verfügbar."</strong></summary>
            <p>Der häufigste Grund ist eine fehlende Telefon-Verifizierung im Facebook-Account:</p>
            <ol>
                <li>Gehe zu <a href="https://accountscenter.facebook.com/personal_info/contact_points" target="_blank">accountscenter.facebook.com</a> (Meta Account Center)</li>
                <li>Klicke auf <strong>„Kontaktinfos"</strong> → <strong>„Telefonnummer"</strong> → Nummer hinzufügen und verifizieren</li>
                <li><a href="https://developers.facebook.com" target="_blank">developers.facebook.com</a> neu laden</li>
            </ol>
            <p>Hilft das nicht, unter <a href="https://www.facebook.com/help/contact/260749603972907" target="_blank">facebook.com/support</a> prüfen, ob der Account Einschränkungen hat.</p>
        </details>

        <details>
            <summary><strong>Fehler: „You don't have access" / kein Login bei developers.facebook.com</strong></summary>
            <p><strong>Mögliche Ursachen und Lösungen:</strong></p>
            <ol>
                <li><strong>Nicht eingeloggt:</strong> Zuerst bei <a href="https://www.facebook.com" target="_blank">facebook.com</a> einloggen, dann developers.facebook.com aufrufen</li>
                <li><strong>Fehlende Verifizierung:</strong> Facebook → Einstellungen → Sicherheit → E-Mail und Telefonnummer verifizieren</li>
                <li><strong>Browser-Cache:</strong> Cache und Cookies löschen (Strg+Shift+Entf) oder Incognito-Modus nutzen</li>
                <li><strong>VPN/Proxy:</strong> Deaktiviere VPN oder Proxy und versuche es erneut</li>
                <li><strong>Anderer Browser:</strong> Versuche es mit Chrome, Firefox oder Edge</li>
            </ol>
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
            <li><a href="https://developers.facebook.com/apps/" target="_blank">Meta Developer Dashboard (Apps)</a></li>
            <li><a href="https://developers.facebook.com/docs/instagram-platform" target="_blank">Instagram Platform Dokumentation</a></li>
            <li><a href="https://developers.facebook.com/docs/facebook-login/" target="_blank">Facebook Login Dokumentation</a></li>
            <li><a href="https://business.facebook.com/" target="_blank">Meta Business Suite</a></li>
        </ul>
    </div>
</div>
