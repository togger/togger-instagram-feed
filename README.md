# Togger Instagram Feed Plugin

Ein modernes WordPress Plugin zur Anzeige von Instagram Posts über die Facebook Graph API.

## Features

✅ Instagram Business Account Integration  
✅ Facebook Graph API v21.0  
✅ Long-Lived Access Tokens (60 Tage Gültigkeit)  
✅ Automatische Token-Erneuerung  
✅ Post-Cache für bessere Performance  
✅ Responsive Grid-Layout  
✅ Video & Bild Support  
✅ Einfacher Shortcode  
✅ Umfassende Admin-Oberfläche mit Tutorial  

## Installation

1. Lade den Ordner `togger-instagram-feed` in das Verzeichnis `/wp-content/plugins/`
2. Aktiviere das Plugin über das WordPress Admin-Menü unter "Plugins"
3. Gehe zu "Instagram Feed" im Admin-Menü
4. Folge der Schritt-für-Schritt-Anleitung im Plugin

## Voraussetzungen

- WordPress 5.0 oder höher
- PHP 7.4 oder höher
- Instagram Business Account oder Creator Account
- Facebook-Seite verbunden mit dem Instagram Account
- Facebook Developer App

## Setup-Anleitung

### 1. Facebook Developer App erstellen

**Option A - Direkter Zugriff:**
1. Gehe zu [developers.facebook.com](https://developers.facebook.com)
2. Klicke auf "Create App" → Wähle "Business" als App-Typ
3. Gib einen App-Namen ein (z.B. "Literaturhaus Instagram Feed")
4. Wähle "Yourself or your own business"

**Option B - Via Business Manager (empfohlen bei Zugriffsproblemen):**
1. Gehe zu [business.facebook.com](https://business.facebook.com)
2. Klicke auf **Business Settings** (Zahnrad-Symbol)
3. Unter **Accounts** → **Apps**
4. Klicke auf **Add** → **Create New App ID**
5. Folge dem gleichen Prozess wie bei Option A

### 2. Instagram Basic Display API einrichten

1. Im App Dashboard: Suche "Instagram Basic Display"
2. Klicke auf "Set Up"
3. Füge Instagram Tester hinzu (dein Instagram Business Account)

### 3. Facebook Login konfigurieren

1. Im App Dashboard: Suche "Facebook Login"
2. Klicke auf "Set Up" → Wähle "Web"
3. Trage die Redirect URI ein (wird im Plugin angezeigt)
4. Speichere die Einstellungen

### 4. App Credentials kopieren

1. Gehe zu Settings → Basic
2. Kopiere "App ID" und "App Secret"
3. Füge sie im Plugin unter "Facebook App Zugangsdaten" ein

### 5. Instagram Account verbinden

1. Stelle sicher, dass dein Instagram ein **Business Account** ist
2. Verbinde ihn mit einer **Facebook-Seite**
3. Klicke im Plugin auf "Mit Facebook verbinden"
4. Erlaube die angeforderten Berechtigungen

## Verwendung

### Shortcode

Füge diesen Shortcode in Posts oder Seiten ein:

```
[togger_instagram_feed]
```

### Shortcode-Parameter

- `limit` - Anzahl der Posts (Standard: 12)
- `columns` - Anzahl der Spalten (Standard: 3)

### Beispiele

```
[togger_instagram_feed limit="6"]
[togger_instagram_feed limit="9" columns="3"]
[togger_instagram_feed limit="8" columns="4"]
```

## Technische Details

### Access Token Verwaltung

- **Short-Lived Token**: Initial 1 Stunde gültig
- **Long-Lived Token**: Automatisch ausgetauscht, 60 Tage gültig
- **Page Access Token**: Verwendet für API-Anfragen
- Automatische Warnung bei Ablauf

### Caching

- Posts werden für 24 Stunden gecacht (WordPress Transients)
- Manuelles Leeren über Admin-Interface möglich
- Verbessert Performance und reduziert API-Calls

### API Endpoints

```
Graph API v21.0:
- /oauth/access_token - Token Exchange
- /me/accounts - Facebook Pages abrufen
- /{page-id}?fields=instagram_business_account - Instagram Account
- /{instagram-account-id}/media - Posts abrufen
```

## Troubleshooting

### "You don't have access" bei developers.facebook.com

**Mögliche Ursachen:**
- Neuer Facebook-Account (muss aktiv und verifiziert sein)
- Fehlende E-Mail/Telefon-Verifizierung
- Business Manager Zugriff erforderlich
- Browser-Cache/Cookie-Probleme
- VPN oder Proxy aktiv
- Account-Einschränkungen

**Lösungen:**
1. **Verifizierung prüfen**: Facebook → Einstellungen → Sicherheit → E-Mail und Telefon verifizieren
2. **Browser zurücksetzen**: Cache und Cookies löschen (Strg+Shift+Entf), Incognito-Modus testen
3. **Alternative Route**: Nutze business.facebook.com → Business Settings → Accounts → Apps statt developers.facebook.com
4. **VPN deaktivieren**: Falls aktiv, VPN/Proxy ausschalten
5. **Anderen Browser testen**: Chrome, Firefox oder Edge probieren
6. **Support kontaktieren**: facebook.com/support für Account-Einschränkungen prüfen

**Empfohlener Workaround**: Erstelle die App direkt über business.facebook.com anstatt über developers.facebook.com

### "Kein Instagram Business Account gefunden"

**Lösung**: Stelle sicher, dass:
- Dein Instagram ein Business/Creator Account ist (kein privater Account)
- Der Account mit einer Facebook-Seite verbunden ist
- Du Zugriff auf die Facebook-Seite hast

### "Invalid OAuth Redirect URI"

**Lösung**: 
- Kopiere die Redirect URI aus dem Plugin
- Füge sie in Facebook App → Products → Facebook Login → Settings → Valid OAuth Redirect URIs ein
- Speichere die Einstellungen

### "Token expired"

**Lösung**:
- Klicke auf "Token aktualisieren" im Plugin
- Oder verbinde dich erneut über "Mit Facebook verbinden"

### "App is in Development Mode"

**Lösung**:
- Gehe zu deiner Facebook App
- Klicke oben rechts auf den Toggle (Development/Live)
- Wechsle zu "Live Mode"

## Datenschutz

Dieses Plugin speichert folgende Daten in der WordPress-Datenbank:

- Facebook App ID und Secret
- Access Tokens (verschlüsselt empfohlen)
- Instagram Account ID
- Facebook Page ID
- Instagram Username
- Gecachte Post-Daten (temporär)

**Keine persönlichen Daten von Besuchern werden gespeichert.**

## Support & Dokumentation

### Offizielle Dokumentation

- [Instagram Basic Display API](https://developers.facebook.com/docs/instagram-basic-display-api)
- [Facebook Login](https://developers.facebook.com/docs/facebook-login/)
- [Graph API Reference](https://developers.facebook.com/docs/graph-api)

### Häufige Fragen

**Q: Wie oft werden die Posts aktualisiert?**  
A: Posts werden 24 Stunden gecacht. Du kannst den Cache manuell leeren.

**Q: Wie viele Posts kann ich anzeigen?**  
A: Standardmäßig bis zu 25 Posts pro API-Request. Nutze den `limit` Parameter.

**Q: Funktioniert es mit privaten Instagram Accounts?**  
A: Nein, du benötigst einen Instagram Business oder Creator Account.

**Q: Kann ich das Design anpassen?**  
A: Ja, über Custom CSS in deinem Theme oder Child Theme.

## Changelog

### Version 2.0
- Komplette Neuentwicklung
- Long-Lived Token Support
- Verbesserte Admin-Oberfläche
- Integrierte Schritt-für-Schritt-Anleitung
- Besseres Error Handling
- Token-Ablauf-Warnung
- Responsive Grid-Layout
- Video-Support

## Lizenz

Dieses Plugin ist proprietär und nur für den internen Gebrauch bestimmt.

## Autor

**Togger**  
Entwickelt für Literaturhaus Wien

---

**Hinweis**: Für produktive Nutzung sollte die Facebook App in den "Live Mode" geschaltet werden und alle erforderlichen Berechtigungen sollten bei Facebook zur Überprüfung eingereicht werden.
