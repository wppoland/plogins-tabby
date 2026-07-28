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

Añade pestañas personalizadas reutilizables con tu propio contenido a cada página de producto de WooCommerce, junto con las pestañas nativas, con HTML seguro.

== Description ==

Tabby te permite añadir tus propias pestañas reutilizables a la página de producto individual de WooCommerce, junto con las pestañas nativas Descripción, Información adicional y Reseñas.

Define tus pestañas una vez en <strong>WooCommerce → Tabby Tabs</strong> y aparecerán en todos los productos. Se adapta al contenido que, si no, pegarías a mano en cada producto: envíos y devoluciones, guías de tallas, instrucciones de cuidado, notas de garantía.

Cada pestaña es un título más un cuadro de contenido que acepta el mismo HTML limitado que WordPress permite en las entradas (enlaces, listas, negrita, encabezados) mediante `wp_kses_post`. Tus pestañas se muestran después de las pestañas nativas de WooCommerce, y puedes activar o desactivar cada una sin eliminarla.

El código está en https://github.com/wppoland/plogins-tabby por si quieres leerlo, informar de un error o sugerir una función de pestañas.

= Documentation and links =

* <strong>Documentación</strong> - https://plogins.com/es/plogins-tabby/docs/
* <strong>Página del plugin</strong> - https://plogins.com/es/plogins-tabby/
* <strong>Código fuente</strong> - https://github.com/wppoland/plogins-tabby
* <strong>Informes de errores y peticiones de funciones</strong> - https://github.com/wppoland/plogins-tabby/issues


= What it does =

* Añade tus pestañas reutilizables a cada página de producto, después de Descripción, Información adicional y Reseñas.
* Almacena el contenido de la pestaña como HTML saneado con `wp_kses_post`, tanto al guardar como de nuevo en la salida.
* Conecta el filtro estándar `woocommerce_product_tabs` con una prioridad tardía, para que las pestañas nativas y las de terceros mantengan tu sitio.
* La pantalla de administración sigue el estilo del núcleo de WordPress y respeta la preferencia de modo claro/oscuro del editor.
* Una pestaña desactivada, o sin contenido, simplemente no se renderiza.

== Installation ==

1. Sube el plugin a `/wp-content/plugins/tabby` o instálalo desde Plugins → Añadir nuevo.
2. Actívalo. WooCommerce debe estar activo.
3. Ve a <strong>WooCommerce → Tabby Tabs</strong> para añadir tus pestañas.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Sí. Tabby requiere una instalación activa de WooCommerce.

= What HTML is allowed in tab content? =

El mismo subconjunto seguro que WordPress permite en el contenido de las entradas (`wp_kses_post`): enlaces, listas, encabezados, negrita/cursiva, imágenes, citas en bloque y similares. Los scripts y el marcado inseguro se eliminan al guardar y al renderizar.

= Where do the custom tabs appear? =

En la lista de pestañas de la página de producto individual, después de las pestañas nativas de WooCommerce (Descripción, Información adicional, Reseñas).

= Can I reuse the same tab on many products? =

Sí. Crea pestañas reutilizables una vez en WooCommerce → Tabby y luego adjúntalas a cada producto.

= Is tab HTML safe? =

Sí. El contenido se sanea con `wp_kses_post` al guardar y en la salida; los scripts se eliminan.


= Does this plugin work on WordPress Multisite? =

Sí. Este plugin es compatible con WordPress Multisite. Actívalo en toda la red o en sitios concretos; cada sitio conserva sus propios ajustes y datos.

== Screenshots ==

1. La pantalla de ajustes de Tabby para gestionar pestañas reutilizables.
2. Pestañas personalizadas renderizadas en la página de producto individual.

== External Services ==

Tabby no se conecta a ningún servicio externo. No realiza llamadas remotas a la API, no carga fuentes, scripts ni estilos de terceros y no envía datos fuera de tu sitio. Tus definiciones de pestañas se almacenan localmente en una única opción de WordPress (`tabby_settings`), con un marcador de versión en `tabby_db_version`, y ambas se eliminan al desinstalar. El CSS y el JavaScript de administración y de frontend que carga se incluyen con el plugin y se sirven desde tu propio sitio.

== Translations ==

Plogins Tabby incluye traducciones al polaco, alemán y español para la interfaz del plugin. El dominio de texto es `plogins-tabby`, así que los paquetes de idioma de WordPress.org también pueden sustituir o ampliar estas traducciones incluidas.

== Changelog ==

= 1.0.2 =
* Añadidas traducciones al polaco, alemán y español para la interfaz del plugin.

= 1.0.1 =
* Primera versión estable.

= 0.1.2 =
* Renombrado a Plogins Tabby para WooCommerce para un nombre de plugin más distintivo.

= 0.1.1 =
* Filtros `tabby/use_rich_tab_content` y `tabby/tab_panel_html` para que los complementos premium puedan ejecutar shortcodes y bloques en el cuerpo de las pestañas.

= 0.1.0 =
* Lanzamiento inicial: pestañas de producto personalizadas y reutilizables con contenido HTML seguro, gestionadas desde una pantalla de ajustes en el submenú de WooCommerce.
