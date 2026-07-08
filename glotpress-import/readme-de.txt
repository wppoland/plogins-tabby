=== Plogins Tabby - Product Tabs for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product tabs, custom tabs, product page, tabs
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.1
Erfordert Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Füge neben den nativen Tabs mit sicherem HTML wiederverwendbare benutzerdefinierte Tabs mit deinem eigenen Inhalt zu jeder WooCommerce-Produktseite hinzu.

== Description ==

Mit Tabby kannst du neben den nativen Registerkarten „Beschreibung“, „Zusätzliche Informationen“ und „Bewertungen“ deine eigenen wiederverwendbaren Registerkarten zur WooCommerce-Einzelproduktseite hinzufügen.

Definiere deine Tabs einmal unter <strong>WooCommerce → Tabby Tabs</strong> und sie werden auf jedem Produkt angezeigt. Es passt zu den Inhalten, die du sonst von Hand in jedes Produkt einfügen würden: Versand und Rücksendungen, Größentabellen, Pflegehinweise, Garantiehinweise.

Jede Registerkarte ist ein Titel und ein Inhaltsfeld, das denselben eingeschränkten HTML-Code akzeptiert, den WordPress in Beiträgen zulässt (Links, Listen, Fettdruck, Überschriften) über „wp_kses_post“. deine Tabs werden nach den nativen WooCommerce-Tabs gerendert, und Du kannst jeden einzelnen ein- oder ausschalten, ohne ihn zu löschen.

Der Code befindet sich unter https://github.com/wppoland/plogins-tabby, wenn du ihn lesen, einen Fehler melden oder eine Tab-Funktion vorschlagen möchten.

= Documentation and links =

* <strong>Dokumentation</strong> - https://plogins.com/de/plogins-tabby/docs/
* <strong>Plugin-Seite</strong> - https://plogins.com/de/plogins-tabby/
* <strong>Quellcode</strong> – https://github.com/wppoland/plogins-tabby
* <strong>Fehlerberichte und Funktionsanfragen</strong> – https://github.com/wppoland/plogins-tabby/issues


= What it does =

* Fügt deine wiederverwendbaren Registerkarten zu jeder einzelnen Produktseite hinzu, nach Beschreibung, zusätzlichen Informationen und Bewertungen.
* Speichert Tab-Inhalte als „wp_kses_post“-bereinigtes HTML, sowohl beim Speichern als auch bei der Ausgabe.
* Bindet den Standardfilter „woocommerce_product_tabs“ mit später Priorität ein, sodass native Tabs und Tabs von Drittanbietern ihren Platz behalten.
* Der Admin-Bildschirm folgt dem Kern-WordPress-Stil und respektiert die Hell/Dunkel-Präferenz des Redakteurs.
* Eine deaktivierte Registerkarte oder eine Registerkarte ohne Inhalt wird einfach nicht gerendert.

== Installation ==

1. Lade das Plugin nach „/wp-content/plugins/tabby“ hoch oder installiere es über Plugins → Neu hinzufügen.
2. Aktiviere es. WooCommerce muss aktiv sein.
3. Gehe zu <strong>WooCommerce → Tabby Tabs</strong>, um deine Tabs hinzuzufügen.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Ja. Tabby erfordert eine aktive WooCommerce-Installation.

= What HTML is allowed in tab content? =

Dieselbe sichere Teilmenge, die WordPress in Post-Inhalten zulässt (`wp_kses_post`): Links, Listen, Überschriften, Fett/Kursiv, Bilder, Blockzitate und ähnliches. Skripte und unsicheres Markup werden beim Speichern und Rendern entfernt.

= Where do the custom tabs appear? =

Auf der Registerkartenliste der einzelnen Produktseite, nach den nativen WooCommerce-Registerkarten (Beschreibung, Zusätzliche Informationen, Bewertungen).

= Can I reuse the same tab on many products? =

Ja. Erstelle einmalig wiederverwendbare Tabs unter WooCommerce → Tabby und hänge sie dann pro Produkt an.

= Is tab HTML safe? =

Ja. Der Inhalt wird beim Speichern und bei der Ausgabe mit „wp_kses_post“ bereinigt; Skripte werden entfernt.


= Does this plugin work on WordPress Multisite? =

Ja. Dieses Plugin ist mit WordPress Multisite kompatibel. Aktiviere es im Netzwerk oder auf einzelnen Websites. Jede Site behält ihre eigenen Einstellungen und Daten.

== Screenshots ==

1. Der Tabby-Einstellungsbildschirm zum Verwalten wiederverwendbarer Tabs.
2. Benutzerdefinierte Registerkarten, die auf der einzelnen Produktseite gerendert werden.

== External Services ==

Tabby stellt keine Verbindung zu externen Diensten her. Es führt keine Remote-API-Aufrufe durch, lädt keine Schriftarten, Skripte oder Stile von Drittanbietern und sendet keine Daten von deiner Website. deine Tab-Definitionen werden lokal in einer einzigen WordPress-Option („tabby_settings“) mit einer Versionsmarkierung in „tabby_db_version“ gespeichert und beide werden bei der Deinstallation entfernt. Das geladene Admin- und Front-End-CSS und JavaScript werden mit dem Plugin gebündelt und von deiner eigenen Website bereitgestellt.

== Changelog ==

= 1.0.1 =
* Erste stabile Version.

= 0.1.2 =
* Für einen eindeutigeren Plugin-Namen in Plogins Tabby für WooCommerce umbenannt.

= 0.1.1 =
* Filter „tabby/use_rich_tab_content“ und „tabby/tab_panel_html“, damit Premium-Add-ons Shortcodes und Blöcke in Tab-Körpern ausführen können.

= 0.1.0 =
* Erstveröffentlichung: wiederverwendbare benutzerdefinierte Produktregisterkarten mit sicherem HTML-Inhalt, verwaltet über einen WooCommerce-Untermenü-Einstellungsbildschirm.
