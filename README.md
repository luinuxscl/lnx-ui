# lnx-ui

Componentes UI compartidos para las aplicaciones derivadas del kit **lnx**. Es un paquete Composer de Blade anónimos, pensado para tener una sola fuente de componentes entre proyectos y permitir que cada app los sobrescriba sin tocar el paquete.

## Instalación

En una app lnx, añade el repositorio (VCS privado en despliegue, `path` en desarrollo local) y requiere el paquete:

```bash
composer require luinuxscl/lnx-ui
```

El `LnxUiServiceProvider` se autodescubre gracias a `extra.laravel.providers`: no hay que registrarlo a mano.

### Tailwind 4

Las clases dentro de `vendor/` no se detectan solas. Añade una línea a `resources/css/app.css`:

```css
@source '../../vendor/luinuxscl/lnx-ui/resources/views';
```

## Uso

Los componentes viven bajo el namespace `lnx-ui`:

```blade
<x-lnx-ui::trend-card label="Sales" value="2.968" change="+3.2%" :series="[10, 20, 30]" color="emerald" />
```

## Sobrescribir un componente

`loadViewsFrom` registra primero `resources/views/vendor/lnx-ui`, así que una app puede reemplazar cualquier componente creando el mismo archivo dentro de `resources/views/vendor/lnx-ui/components/`:

```
resources/views/vendor/lnx-ui/components/trend-card.blade.php
```

Para publicar todas las vistas del paquete y editarlas:

```bash
php artisan vendor:publish --tag=lnx-ui-views
```

## Galería de diseño

El paquete incluye la vista `lnx-ui::design-gallery`: el catálogo de componentes agrupados por tipo, cada uno con un nombre y un ancla estable (`#<nombre>`) para referenciarlo con la IA. Es contenido sin layout; la app lo envuelve en su propio layout y decide la ruta y el gating:

```blade
{{-- resources/views/design-gallery.blade.php --}}
<x-layouts::app :title="__('Design gallery')" :breadcrumbs="[['label' => __('Design gallery')]]">
    @include('lnx-ui::design-gallery')
</x-layouts::app>
```

Las cadenas de la galería viven en el namespace `lnx-ui::design-gallery` (`lang/{en,es}/design-gallery.php`) y se pueden sobrescribir en `lang/vendor/lnx-ui/{locale}/design-gallery.php`.

## Componentes disponibles

| Componente | Props |
| --- | --- |
| `x-lnx-ui::stat` | `label`, `value`, `icon`, `color` |
| `x-lnx-ui::stat-card` | `label`, `value`, `icon`, `color` (envuelve `stat` en `flux:card`) |
| `x-lnx-ui::statistics-panel` | `title`, `updated-label` y `updated-icon` (opcionales); slots de métricas, `actions`, `description` y `empty` |
| `x-lnx-ui::trend-card` | `label`, `value`, `change`, `series` (array), `color` |
| `x-lnx-ui::chart-card` | `label`, `value`; `description`, `change`, `trend`, `change-style` (`text` por defecto), `series` (array), `chart` (`line`/`bar`), `labels` (array), `color` |
| `x-lnx-ui::metric-card` | `label`, `value`, `icon`; `description`, `change`, `trend`, `change-style` (`badge` por defecto), `color` |
| `x-lnx-ui::tool-card` | `title`, `description`, `icon`, `href`, `color`, `external` |
| `x-lnx-ui::resource-card` | `title`, `description`, `icon`, `eyebrow`, `href`, `external`, `color`; slots `badges`, `tags`, `meta`, `actions` |
| `x-lnx-ui::placeholder-pattern` | `id` (opcional) |
| `x-lnx-ui::auth-header` | `title`, `description` |
| `x-lnx-ui::auth-session-status` | `status` |
| `x-lnx-ui::chip` | `label`, `icon`, `color`; el slot es el fallback |
| `x-lnx-ui::media-cell` | `title`, `description`, `icon`, `image`, `href`, `color` |
| `x-lnx-ui::summary-card` | `label`, `value`, `caption`, `change`, `icon`, `color` |
| `x-lnx-ui::data-table` | `title` (opcional), `description`, `filters-label`, `paginate`, `table-class`, `container-class`; slots `filters`, `toolbar`, `actions` y el contenido de la tabla |

`color` acepta `accent` (predeterminado), `violet`, `cyan`, `rose`, `emerald`, `blue` y `amber`.

`data-table` renderiza el `title` solo si se entrega: sin título ni slot `filters`, desaparece la fila superior. `container-class` se reenvía al contenedor de scroll de `flux:table`, útil para fijar el encabezado (por ejemplo `container-class="max-h-[70vh]"` junto con `sticky` en `flux:table.columns`).

En `chart-card` y `metric-card`, la variación (`change`) se colorea en verde o rojo según su signo; `trend` (`up`/`down`) lo sobrescribe. El contenedor asigna el ancho, normalmente `col-span-12 md:col-span-6 xl:col-span-3`.

## Versionado

El paquete sigue [SemVer](https://semver.org/). Las apps consumidoras requieren `^1.0`, de modo que las adiciones de componentes (minor) se reciben con `composer update luinuxscl/lnx-ui` sin tocar `composer.json`.

## Desarrollo

```bash
composer install
vendor/bin/pest
vendor/bin/pint
```

## Convención de extracción

Un componente se mueve a este paquete cuando es **presentacional puro**: no consulta la base de datos, no lee modelos del host (`App\Models\*`) y no depende de rutas ni servicios de la app. Los componentes acoplados al host (`app-logo`, `user-avatar`, `desktop-user-menu`, etc.) se quedan en la aplicación.
