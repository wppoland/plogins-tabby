=== Plogins Tabby - Product Tabs for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product tabs, custom tabs, product page, tabs
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.1
Wymaga wtyczek: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Dodaj niestandardowe karty wielokrotnego użytku z własną treścią do każdej strony produktu WooCommerce, obok zakładek natywnych, z bezpiecznym kodem HTML.

== Description ==

Tabby umożliwia dodawanie własnych zakładek wielokrotnego użytku do strony pojedynczego produktu WooCommerce, obok natywnych zakładek Opis, Dodatkowe informacje i Recenzje.

Zdefiniuj swoje karty raz w <strong>WooCommerce → Tabby Tabby</strong>, a będą one wyświetlane przy każdym produkcie. Pasuje do treści, które w przeciwnym razie wklejałbyś ręcznie do każdego produktu: wysyłka i zwroty, przewodniki po rozmiarach, instrukcje dotyczące pielęgnacji, uwagi gwarancyjne.

Każda zakładka to tytuł i pole treści, które akceptuje ten sam ograniczony kod HTML, na jaki pozwala WordPress w postach (linki, listy, pogrubienie, nagłówki) za pośrednictwem `wp_kses_post`. Twoje karty renderują się po natywnych kartach WooCommerce i możesz włączać i wyłączać każdą z nich bez usuwania.

Kod znajduje się pod adresem https://github.com/wppoland/plogins-tabby, jeśli chcesz go przeczytać, zgłosić błąd lub zasugerować funkcję zakładki.

= Documentation and links =

* <strong>Dokumentacja</strong> - https://plogins.com/pl/plogins-tabby/docs/
* <strong>Strona wtyczki</strong> - https://plogins.com/pl/plogins-tabby/
* <strong>Kod źródłowy</strong> - https://github.com/wppoland/plogins-tabby
* <strong>Raporty o błędach i prośby o nowe funkcje</strong> - https://github.com/wppoland/plogins-tabby/issues


= What it does =

* Dodaje zakładki wielokrotnego użytku do każdej strony produktu, po opisie, informacjach dodatkowych i recenzjach.
* Przechowuje zawartość zakładek w formacie HTML oczyszczonym za pomocą `wp_kses_post`, zarówno przy zapisywaniu, jak i ponownym wyświetlaniu.
* Przechwytuje standardowy filtr `woocommerce_product_tabs` z późnym priorytetem, dzięki czemu karty natywne i strony trzecie zachowują swoje miejsce.
* Ekran administracyjny jest zgodny ze stylem WordPressa i uwzględnia preferencje redaktora dotyczące jasności/ciemności.
* Wyłączona karta lub taka, która nie zawiera treści, po prostu nie jest renderowana.

== Installation ==

1. Prześlij wtyczkę do `/wp-content/plugins/tabby` lub zainstaluj poprzez Wtyczki → Dodaj nową.
2. Aktywuj. WooCommerce musi być aktywny.
3. Przejdź do <strong>WooCommerce → Tabby Tabby</strong>, aby dodać swoje karty.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Tak. Tabby wymaga aktywnej instalacji WooCommerce.

= What HTML is allowed in tab content? =

Ten sam bezpieczny podzbiór WordPress pozwala na zawartość postów („wp_kses_post”): linki, listy, nagłówki, pogrubienie/kursywa, obrazy, cytaty blokowe i tym podobne. Skrypty i niebezpieczne znaczniki są usuwane podczas zapisywania i renderowania.

= Where do the custom tabs appear? =

Na liście zakładek na stronie pojedynczego produktu, po natywnych zakładkach WooCommerce (Opis, Informacje dodatkowe, Recenzje).

= Can I reuse the same tab on many products? =

Tak. Utwórz zakładki wielokrotnego użytku w WooCommerce → Tabby, a następnie dołącz je do każdego produktu.

= Is tab HTML safe? =

Tak. Treść jest oczyszczana za pomocą `wp_kses_post` przy zapisywaniu i wyjściu; skrypty są usuwane.


= Does this plugin work on WordPress Multisite? =

Tak. Ta wtyczka jest kompatybilna z WordPress Multisite. Aktywuj go w sieci lub aktywuj na poszczególnych stronach; każda witryna przechowuje własne ustawienia i dane.

== Screenshots ==

1. Ekran ustawień Tabby do zarządzania zakładkami wielokrotnego użytku.
2. Niestandardowe zakładki renderowane na stronie pojedynczego produktu.

== External Services ==

Tabby nie łączy się z żadnymi usługami zewnętrznymi. Nie wykonuje zdalnych wywołań API, nie ładuje czcionek, skryptów ani stylów od osób trzecich i nie wysyła żadnych danych poza Twoją witrynę. Twoje definicje zakładek są przechowywane lokalnie w jednej opcji WordPress („tabby_settings”), ze znacznikiem wersji w „tabby_db_version” i oba są usuwane podczas dezinstalacji. Ładowane przez niego administracyjne i front-endowe CSS i JavaScript są dołączone do wtyczki i udostępniane z Twojej własnej witryny.

== Changelog ==

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.1.2 =
* Zmieniono nazwę na Plogins Tabby dla WooCommerce, aby uzyskać bardziej charakterystyczną nazwę wtyczki.

= 0.1.1 =
* Filtry `tabby/use_rich_tab_content` i `tabby/tab_panel_html`, dzięki którym dodatki premium mogą uruchamiać krótkie kody i bloki w treści zakładek.

= 0.1.0 =
* Pierwsza wersja: niestandardowe karty produktów wielokrotnego użytku z bezpieczną zawartością HTML, zarządzane z poziomu ekranu ustawień podmenu WooCommerce.
