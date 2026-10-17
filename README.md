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
| `x-lnx-ui::chart-card` | `label`, `value`; `description`, `help`, `change`, `trend`, `change-style` (`text` por defecto), `series` (array), `chart` (`line`/`bar`), `labels` (array), `color` |
| `x-lnx-ui::metric-card` | `label`, `value`, `icon`; `description`, `help`, `change`, `trend`, `change-style` (`badge` por defecto), `color` |
| `x-lnx-ui::tool-card` | `title`, `description`, `icon`, `href`, `color`, `external` |
| `x-lnx-ui::resource-card` | `title`, `description`, `icon`, `eyebrow`, `href`, `external`, `color`; slots `badges`, `tags`, `meta`, `actions` |
| `x-lnx-ui::placeholder-pattern` | `id` (opcional) |
| `x-lnx-ui::auth-header` | `title`, `description` |
| `x-lnx-ui::auth-session-status` | `status` |
| `x-lnx-ui::chip` | `label`, `icon`, `color`; el slot es el fallback |
| `x-lnx-ui::media-cell` | `title`, `description`, `icon`, `image`, `href`, `color` |
| `x-lnx-ui::summary-card` | `label`, `value`, `caption`, `change`, `icon`, `color` |
| `x-lnx-ui::page-header` | `title`, `subtitle`, `icon`, `color`; slot `actions` |
| `x-lnx-ui::data-table` | `title` (opcional), `description`, `filters-label`, `paginate`, `table-class`, `container-class`; slots `filters`, `toolbar`, `actions` y el contenido de la tabla |
| `x-lnx-ui::data-table-inline` | `title` (opcional), `description`, `paginate`, `table-class`, `container-class`; slots `filters`, `filtersActions`, `toolbar`, `actions` y el contenido de la tabla |
| `x-lnx-ui::mail-list-item` | `sender`, `email`, `avatar`, `subject`, `preview`, `time`, `unread`, `starred`, `selected`, `badge` (`['label' => …, 'color' => …]`), `href`, `select-label`, `star-label`; slots `select`, `star` |
| `x-lnx-ui::attachment-card` | `name`, `size`, `icon`, `color`, `href`; slot `action` |
| `x-lnx-ui::presence-list` | `title` (opcional), `users` (array de `name`, `avatar`, `line`, `online`) |
| `x-lnx-ui::mail-viewer` | `sender`, `email`, `avatar`, `subject`, `date`; slots `actions`, `attachments`, `reply`, `footer` y el cuerpo por defecto |

`color` acepta `accent` (predeterminado), `violet`, `cyan`, `rose`, `emerald`, `blue` y `amber`.

Los componentes de correo (`mail-list-item`, `attachment-card`, `presence-list`, `mail-viewer`) son presentacionales: el consumidor aporta los textos ya traducidos y los datos ya formateados. Sus etiquetas accesibles viven en el namespace `lnx-ui::components` (`lang/{en,es}/components.php`) y se pueden sobrescribir con `select-label`/`star-label`.

`page-header` es el encabezado estándar de una página: un solo `<h1>` con el título, un subtítulo opcional y un badge de icono opcional. Las acciones de la página van en el slot `actions`, alineadas a la derecha:

```blade
<x-lnx-ui::page-header
    :title="__('Users')"
    :subtitle="__('Manage accounts, roles and invitations.')"
    icon="users"
    color="blue"
>
    <x-slot:actions>
        <flux:button variant="primary" icon="plus">{{ __('Invite user') }}</flux:button>
    </x-slot:actions>
</x-lnx-ui::page-header>
```

`data-table-inline` es la variante compacta de `data-table` para barras de filtros: no muestra el rótulo de filtros y coloca el slot `filtersActions` (exportar, limpiar, etc.) alineado a la derecha dentro de la misma fila que `filters`, ajustándose a ancho completo en pantallas estrechas.

`data-table` renderiza el `title` solo si se entrega: sin título ni slot `filters`, desaparece la fila superior. `container-class` se reenvía al contenedor de `flux:table` (el que envuelve la tabla, el pie y la paginación), útil para acotar la altura y fijar el encabezado (por ejemplo `container-class="max-h-[70vh] overflow-auto"` junto con `sticky` en `flux:table.columns`). No lo uses para el ancho.

En pantallas estrechas **no fuerces un ancho mínimo con `table-class="min-w-[…]"`**: crea un scroll horizontal sin barra visible que la tarjeta recorta y deja columnas inalcanzables. En su lugar, **oculta columnas por breakpoint** (`max-sm:hidden`, `max-md:hidden`, `max-lg:hidden`, `max-xl:hidden`) en la columna de `flux:table.columns` y en su celda, de modo que la tabla siempre quepa sin scroll horizontal. La galería (`#data-table`) es el ejemplo de referencia. Si de verdad necesitas un suelo de ancho, que sea responsivo y coherente con las columnas que ocultas.

En `chart-card` y `metric-card`, la variación (`change`) se colorea en verde o rojo según su signo; `trend` (`up`/`down`) lo sobrescribe. El contenedor asigna el ancho, normalmente `col-span-12 md:col-span-6 xl:col-span-3`.

En `chart-card` y `metric-card`, `help` añade un texto de ayuda inline bajo la descripción para explicar conceptos poco obvios. Cuando se entrega, la tarjeta se expone como grupo accesible (`role="group"`) asociado a la etiqueta y a la ayuda con `aria-labelledby`/`aria-describedby`; sin `help`, el render es idéntico al anterior:

```blade
<x-lnx-ui::metric-card :label="__('Total sales')" value="24.67k" icon="shopping-bag" :help="__('Includes confirmed and pending records.')" />
```

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
