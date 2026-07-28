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

Dodaj do każdej strony produktu WooCommerce własne zakładki wielokrotnego użytku z własną treścią, obok zakładek natywnych, z bezpiecznym kodem HTML.

== Description ==

Tabby umożliwia dodawanie własnych zakładek wielokrotnego użytku do strony pojedynczego produktu WooCommerce, obok natywnych zakładek Opis, Dodatkowe informacje i Recenzje.

Zdefiniuj swoje zakładki raz w <strong>WooCommerce → Tabby Tabs</strong>, a pojawią się przy każdym produkcie. Sprawdza się przy treściach, które inaczej wklejałbyś ręcznie do każdego produktu: wysyłka i zwroty, tabele rozmiarów, instrukcje pielęgnacji, informacje o gwarancji.

Każda zakładka to tytuł oraz pole treści, które przyjmuje ten sam ograniczony zestaw HTML, na jaki WordPress pozwala we wpisach (linki, listy, pogrubienie, nagłówki), poprzez `wp_kses_post`. Twoje zakładki renderują się po natywnych zakładkach WooCommerce i możesz włączać lub wyłączać każdą z nich bez usuwania.

Kod jest dostępny pod adresem https://github.com/wppoland/plogins-tabby, jeśli chcesz go przejrzeć, zgłosić błąd lub zaproponować funkcję zakładek.

= Documentation and links =

* <strong>Dokumentacja</strong> - https://plogins.com/pl/plogins-tabby/docs/
* <strong>Strona wtyczki</strong> - https://plogins.com/pl/plogins-tabby/
* <strong>Kod źródłowy</strong> - https://github.com/wppoland/plogins-tabby
* <strong>Zgłoszenia błędów i propozycje funkcji</strong> - https://github.com/wppoland/plogins-tabby/issues


= What it does =

* Dodaje Twoje zakładki wielokrotnego użytku do każdej strony produktu, po zakładkach Opis, Informacje dodatkowe i Recenzje.
* Przechowuje treść zakładek jako kod HTML oczyszczony przez `wp_kses_post`, zarówno przy zapisie, jak i ponownie przy wyświetlaniu.
* Podpina standardowy filtr `woocommerce_product_tabs` z późnym priorytetem, dzięki czemu zakładki natywne i te od podmiotów trzecich zachowują swoje miejsce.
* Ekran administracyjny jest zgodny ze stylem rdzenia WordPressa i respektuje preferencję jasnego/ciemnego trybu edytora.
* Wyłączona zakładka lub taka bez treści po prostu nie jest renderowana.

== Installation ==

1. Prześlij wtyczkę do `/wp-content/plugins/tabby` lub zainstaluj przez Wtyczki → Dodaj nową.
2. Włącz ją. WooCommerce musi być aktywne.
3. Przejdź do <strong>WooCommerce → Tabby Tabs</strong>, aby dodać swoje zakładki.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Tak. Tabby wymaga aktywnej instalacji WooCommerce.

= What HTML is allowed in tab content? =

Ten sam bezpieczny podzbiór, na jaki WordPress pozwala w treści wpisów (`wp_kses_post`): linki, listy, nagłówki, pogrubienie/kursywa, obrazy, cytaty blokowe i podobne. Skrypty i niebezpieczne znaczniki są usuwane przy zapisie i renderowaniu.

= Where do the custom tabs appear? =

Na liście zakładek na stronie pojedynczego produktu, po natywnych zakładkach WooCommerce (Opis, Informacje dodatkowe, Recenzje).

= Can I reuse the same tab on many products? =

Tak. Utwórz zakładki wielokrotnego użytku raz w WooCommerce → Tabby, a następnie podłącz je do poszczególnych produktów.

= Is tab HTML safe? =

Tak. Treść jest oczyszczana za pomocą `wp_kses_post` przy zapisie i na wyjściu; skrypty są usuwane.


= Does this plugin work on WordPress Multisite? =

Tak. Ta wtyczka jest kompatybilna z WordPress Multisite. Włącz ją dla całej sieci lub w poszczególnych witrynach; każda witryna zachowuje własne ustawienia i dane.

== Screenshots ==

1. Ekran ustawień Tabby do zarządzania zakładkami wielokrotnego użytku.
2. Niestandardowe zakładki renderowane na stronie pojedynczego produktu.

== External Services ==

Tabby nie łączy się z żadnymi usługami zewnętrznymi. Nie wykonuje zdalnych wywołań API, nie ładuje czcionek, skryptów ani stylów od podmiotów trzecich i nie wysyła żadnych danych poza Twoją witrynę. Twoje definicje zakładek są przechowywane lokalnie w jednej opcji WordPressa (`tabby_settings`), ze znacznikiem wersji w `tabby_db_version`, oba są usuwane przy odinstalowaniu. Ładowane przez wtyczkę CSS i JavaScript panelu oraz front-endu są dołączone do wtyczki i serwowane z Twojej własnej witryny.

== Translations ==

Plogins Tabby zawiera polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki. Domena tekstowa to `plogins-tabby`, więc pakiety językowe z WordPress.org mogą też nadpisywać lub rozszerzać te dołączone tłumaczenia.

== Changelog ==

= 1.0.2 =
* Dodano dołączone polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki.

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.1.2 =
* Zmieniono nazwę na Plogins Tabby dla WooCommerce, aby uzyskać bardziej charakterystyczną nazwę wtyczki.

= 0.1.1 =
* Filtry `tabby/use_rich_tab_content` i `tabby/tab_panel_html`, dzięki którym dodatki premium mogą uruchamiać shortcode i bloki w treści zakładek.

= 0.1.0 =
* Pierwsza wersja: niestandardowe zakładki produktów wielokrotnego użytku z bezpieczną zawartością HTML, zarządzane z poziomu ekranu ustawień w podmenu WooCommerce.
