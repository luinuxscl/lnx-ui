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

## Componentes disponibles

| Componente | Props |
| --- | --- |
| `x-lnx-ui::trend-card` | `label`, `value`, `change`, `series` (array), `color` (`accent` predeterminado, `emerald`, `amber`, `rose`) |

## Desarrollo

```bash
composer install
vendor/bin/pest
vendor/bin/pint
```

## Convención de extracción

Un componente se mueve a este paquete cuando es **presentacional puro**: no consulta la base de datos, no lee modelos del host (`App\Models\*`) y no depende de rutas ni servicios de la app. Los componentes acoplados al host (`app-logo`, `user-avatar`, `desktop-user-menu`, etc.) se quedan en la aplicación.
