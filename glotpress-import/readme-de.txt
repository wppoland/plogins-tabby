=== Plogins Tabby - Product Tabs for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product tabs, custom tabs, product page, tabs
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.2
Requires Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Füge jeder WooCommerce-Produktseite neben den nativen Tabs wiederverwendbare eigene Tabs mit deinem eigenen Inhalt und sicherem HTML hinzu.

== Description ==

Mit Tabby kannst du der WooCommerce-Einzelproduktseite deine eigenen wiederverwendbaren Tabs hinzufügen, neben den nativen Tabs „Beschreibung“, „Weitere Informationen“ und „Bewertungen“.

Definiere deine Tabs einmal unter <strong>WooCommerce → Tabby Tabs</strong> und sie erscheinen bei jedem Produkt. Das passt zu Inhalten, die du sonst von Hand in jedes Produkt einfügen würdest: Versand und Rücksendungen, Größentabellen, Pflegehinweise, Garantiehinweise.

Jeder Tab besteht aus einem Titel und einem Inhaltsfeld, das dasselbe eingeschränkte HTML akzeptiert, das WordPress in Beiträgen erlaubt (Links, Listen, Fettdruck, Überschriften), über `wp_kses_post`. Deine Tabs werden nach den nativen WooCommerce-Tabs gerendert, und du kannst jeden einzelnen ein- oder ausschalten, ohne ihn zu löschen.

Der Code liegt unter https://github.com/wppoland/plogins-tabby, falls du ihn lesen, einen Fehler melden oder eine Tab-Funktion vorschlagen möchtest.

= Documentation and links =

* <strong>Dokumentation</strong> - https://plogins.com/de/plogins-tabby/docs/
* <strong>Plugin-Seite</strong> - https://plogins.com/de/plogins-tabby/
* <strong>Quellcode</strong>, https://github.com/wppoland/plogins-tabby
* <strong>Fehlerberichte und Funktionswünsche</strong>, https://github.com/wppoland/plogins-tabby/issues


= What it does =

* Fügt deine wiederverwendbaren Tabs zu jeder einzelnen Produktseite hinzu, nach Beschreibung, Weiteren Informationen und Bewertungen.
* Speichert Tab-Inhalte als mit `wp_kses_post` bereinigtes HTML, sowohl beim Speichern als auch bei der Ausgabe.
* Bindet den Standard-Filter `woocommerce_product_tabs` mit später Priorität ein, sodass native Tabs und Tabs von Drittanbietern ihren Platz behalten.
* Der Admin-Bildschirm folgt dem Core-WordPress-Stil und respektiert die Hell-/Dunkel-Einstellung des Editors.
* Ein deaktivierter Tab oder ein Tab ohne Inhalt wird einfach nicht gerendert.

== Installation ==

1. Lade das Plugin nach `/wp-content/plugins/tabby` hoch oder installiere es über Plugins → Installieren.
2. Aktiviere es. WooCommerce muss aktiv sein.
3. Gehe zu <strong>WooCommerce → Tabby Tabs</strong>, um deine Tabs hinzuzufügen.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Ja. Tabby erfordert eine aktive WooCommerce-Installation.

= What HTML is allowed in tab content? =

Dieselbe sichere Teilmenge, die WordPress in Beitragsinhalten zulässt (`wp_kses_post`): Links, Listen, Überschriften, Fett/Kursiv, Bilder, Blockzitate und Ähnliches. Skripte und unsicheres Markup werden beim Speichern und Rendern entfernt.

= Where do the custom tabs appear? =

In der Tab-Liste der einzelnen Produktseite, nach den nativen WooCommerce-Tabs (Beschreibung, Weitere Informationen, Bewertungen).

= Can I reuse the same tab on many products? =

Ja. Erstelle wiederverwendbare Tabs einmalig unter WooCommerce → Tabby und hänge sie dann pro Produkt an.

= Is tab HTML safe? =

Ja. Der Inhalt wird beim Speichern und bei der Ausgabe mit `wp_kses_post` bereinigt; Skripte werden entfernt.


= Does this plugin work on WordPress Multisite? =

Ja. Dieses Plugin ist mit WordPress Multisite kompatibel. Aktiviere es netzwerkweit oder auf einzelnen Websites; jede Website behält ihre eigenen Einstellungen und Daten.

== Screenshots ==

1. Der Tabby-Einstellungsbildschirm zum Verwalten wiederverwendbarer Tabs.
2. Benutzerdefinierte Tabs, die auf der einzelnen Produktseite gerendert werden.

== External Services ==

Tabby stellt keine Verbindung zu externen Diensten her. Es führt keine Remote-API-Aufrufe aus, lädt keine Schriftarten, Skripte oder Styles von Dritten und sendet keine Daten von deiner Website weg. Deine Tab-Definitionen werden lokal in einer einzigen WordPress-Option (`tabby_settings`) mit einer Versionsmarkierung in `tabby_db_version` gespeichert, beide werden bei der Deinstallation entfernt. Das Admin- und Frontend-CSS und -JavaScript, das es lädt, sind im Plugin gebündelt und werden von deiner eigenen Website ausgeliefert.

== Translations ==

Plogins Tabby enthält deutsche, polnische und spanische Übersetzungen für die Plugin-Oberfläche. Die Textdomain ist `plogins-tabby`, sodass Sprachpakete von WordPress.org diese mitgelieferten Übersetzungen ebenfalls überschreiben oder erweitern können.

== Changelog ==

= 1.0.2 =
* Deutsche, polnische und spanische Übersetzungen für die Plugin-Oberfläche mitgeliefert.

= 1.0.1 =
* Erste stabile Version.

= 0.1.2 =
* Für einen eindeutigeren Plugin-Namen in Plogins Tabby für WooCommerce umbenannt.

= 0.1.1 =
* Filter `tabby/use_rich_tab_content` und `tabby/tab_panel_html`, damit Premium-Add-ons Shortcodes und Blöcke in Tab-Inhalten ausführen können.

= 0.1.0 =
* Erstveröffentlichung: wiederverwendbare benutzerdefinierte Produkt-Tabs mit sicherem HTML-Inhalt, verwaltet über einen Einstellungsbildschirm im WooCommerce-Untermenü.
