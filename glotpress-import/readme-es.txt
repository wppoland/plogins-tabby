=== Plogins Tabby - Product Tabs for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product tabs, custom tabs, product page, tabs
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.1
Requiere complementos: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Añade pestañas personalizadas reutilizables con su propio contenido a cada página de producto de WooCommerce, junto con las pestañas nativas, con HTML seguro.

== Description ==

Tabby le permite añadir sus propias pestañas reutilizables a la página de producto único de WooCommerce, junto con las pestañas nativas Descripción, Información adicional y Reseñas.

Defina sus pestañas una vez en <strong>WooCommerce → Tabby Tabs</strong> y aparecerán en todos los productos. Se adapta al contenido que, de otro modo, pegaría a mano en cada producto: envíos y devoluciones, guías de tallas, instrucciones de cuidado, notas de garantía.

Cada pestaña es un título más un cuadro de contenido que acepta el mismo HTML limitado que WordPress permite en las publicaciones (enlaces, listas, negrita, encabezados) a través de `wp_kses_post`. Sus pestañas se muestran después de las pestañas nativas de WooCommerce, y puede activar o desactivar cada una sin eliminarlas.

El código se encuentra en https://github.com/wppoland/plogins-tabby si desea leerlo, informar un error o sugerir una función de pestaña.

= Documentation and links =

* <strong>Documentación</strong> - https://plogins.com/es/plogins-tabby/docs/
* <strong>Página de complementos</strong> - https://plogins.com/es/plogins-tabby/
* <strong>Código fuente</strong> - https://github.com/wppoland/plogins-tabby
* <strong>Informes de errores y solicitudes de funciones</strong> - https://github.com/wppoland/plogins-tabby/issues


= What it does =

* Añade pestañas reutilizables a cada página de producto, después de Descripción, Información adicional y Reseñas.
* Almacena el contenido de la pestaña como HTML desinfectado con `wp_kses_post`, tanto al guardar como nuevamente al generar.
* Conecta el filtro estándar `woocommerce_product_tabs` con una prioridad tardía, para que las pestañas nativas y de terceros mantengan su lugar.
* La pantalla de administración sigue el estilo central de WordPress y respeta la preferencia claro/oscuro del editor.
* Una pestaña deshabilitada o sin contenido simplemente no se representa.

== Installation ==

1. Cargue el complemento en `/wp-content/plugins/tabby`, o instálelo a través de Complementos → Añadir nuevo.
2. Actívalo. WooCommerce debe estar activo.
3. Vaya a <strong>WooCommerce → Tabby Tabs</strong> para añadir sus pestañas.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Sí. Tabby requiere una instalación activa de WooCommerce.

= What HTML is allowed in tab content? =

El mismo subconjunto seguro que WordPress permite en el contenido de las publicaciones (`wp_kses_post`): enlaces, listas, encabezados, negrita/cursiva, imágenes, citas en bloque y similares. Los scripts y las marcas inseguras se eliminan al guardar y al renderizar.

= Where do the custom tabs appear? =

En la lista de pestañas de la página de un solo producto, después de las pestañas nativas de WooCommerce (Descripción, Información adicional, Reseñas).

= Can I reuse the same tab on many products? =

Sí. Cree pestañas reutilizables una vez en WooCommerce → Tabby, luego adjúntelas por producto.

= Is tab HTML safe? =

Sí. El contenido se desinfecta con `wp_kses_post` al guardar y al generar; Los guiones se eliminan.


= Does this plugin work on WordPress Multisite? =

Sí. Este complemento es compatible con WordPress Multisite. Activarlo en red o activarlo en sitios individuales; Cada sitio mantiene su propia configuración y datos.

== Screenshots ==

1. La pantalla de configuración de Tabby para administrar pestañas reutilizables.
2. Pestañas personalizadas representadas en la página de un solo producto.

== External Services ==

Tabby no se conecta a ningún servicio externo. No realiza llamadas API remotas, no carga fuentes, scripts o estilos de terceros y no envía datos fuera de tu sitio. Las definiciones de sus pestañas se almacenan localmente en una única opción de WordPress (`tabby_settings`), con un marcador de versión en `tabby_db_version`, y ambas se eliminan al desinstalarlas. El administrador y el CSS y JavaScript del front-end que carga se incluyen con el complemento y se sirven desde tu propio sitio.

== Changelog ==

= 1.0.1 =
* Primera versión estable.

= 0.1.2 =
* Renombrado a Plogins Tabby para WooCommerce para obtener un nombre de complemento más distintivo.

= 0.1.1 =
* Filtros `tabby/use_rich_tab_content` y `tabby/tab_panel_html` para que los complementos premium puedan ejecutar códigos cortos y bloques en los cuerpos de las pestañas.

= 0.1.0 =
* Lanzamiento inicial: pestañas de productos personalizadas reutilizables con contenido HTML seguro, administradas desde una pantalla de configuración del submenú de WooCommerce.
