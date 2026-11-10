---
name: lnx-ui-component-preview
description: >-
  Guía el ciclo de diseño de componentes lnx-ui con previsualización en borradores
  de Like UI y, cuando convenga, en el producto CRM (crm-app). Mantiene sincronizados
  checkout path de lnx-ui, Composer, npm y galería/snippets. Úsala al crear o iterar
  un componente nuevo, al trabajar en borradores de Like UI, al previsualizar en CRM,
  o cuando el usuario pida mantener dependencias y apps consumidoras al día.
---

# Vista previa de componentes lnx-ui

## Prioridad del usuario

1. **Primera pantalla casi siempre:** borrador en **Like UI** (`/biblioteca/borradores`).
2. **A veces:** mismo candidato integrado en **CRM** (`crm-app`) con datos y layout reales.
3. **Siempre:** dependencias y consumidores al día antes de dar por cerrado un cambio.

## Mapa de repositorios

| Rol | Ruta | Notas |
| --- | --- | --- |
| Paquete (fuente) | `/home/luinux/Code/lnx-ui` | Blade-only, `x-lnx-ui::`, galería y snippets |
| Visor / borradores | `/home/luinux/Code/like-ui` | Composer `path` → `../lnx-ui`, `dev-develop` |
| Producto de ejemplo | `/home/luinux/Code/crm-app` | App lnx + módulo `luinuxscl/crm`; el producto se llama **CRM** (no “LikeCRM” en UI) |
| Kit | `/home/luinux/Code/lnx` | `create-ui-component`, galería admin |

Lee `.ai/rules/local.md` del proyecto activo antes de editar.

## Flujo A — Borrador en Like UI (por defecto)

1. Crea `like-ui/resources/views/drafts/{nombre}.blade.php` con datos de muestra estáticos (sin Eloquent ni rutas del dominio).
2. Usa `x-lnx-ui::…` para piezas del paquete; Alpine local solo si hace falta antes de extraer al paquete.
3. Abre `/biblioteca/borradores` y comprueba claro/oscuro, móvil/escritorio y acentos.
4. Si el componente necesita JS del paquete (`rich-text-editor`, `kanban`): importa o copia el entry en `like-ui/resources/js/app.js` y ejecuta `npm run build` en Like UI.
5. Cuando el usuario apruebe: mueve la vista a `lnx-ui/resources/views/components/`, añade ejemplo en `resources/views/gallery/` (categoría + `snippets/{nombre}.blade.txt`), prueba Pest y sigue `lnx-ui-release`.

No dejes lógica de negocio en el borrador; solo presentación y datos fake.

## Flujo B — Previsualización en CRM (crm-app)

Usar cuando el usuario pida ver el componente **en contexto de producto** (pipeline, listas, formularios CRM).

1. Confirma que `crm-app` ve el mismo `lnx-ui` que estás editando:
   - Iteración rápida: `composer config repositories.lnx-ui path ../lnx-ui` + `symlink: true` y `composer require luinuxscl/lnx-ui:dev-develop` (como Like UI), **solo en local**; revierte antes de commitear en crm-app si el repo no debe fijar path.
   - Si ya publicaste tag: `composer update luinuxscl/lnx-ui` en crm-app.
2. Integra el candidato en la **pantalla o ruta mínima** acordada (Livewire shell en la app, piezas en `x-lnx-ui::`), no dupliques markup que ya vive en el paquete.
3. `npm run build` en crm-app si añades o cambias entradas JS.
4. Ejecuta pruebas del módulo CRM o de la pantalla tocada si existen.

Si el borrador sigue activo en Like UI, mantén **una sola API** (mismas props/slots) en ambos sitios.

## Mantener todo actualizado (obligatorio en cada iteración relevante)

### En `lnx-ui`

```bash
cd /home/luinux/Code/lnx-ui
composer install
vendor/bin/pest
vendor/bin/pint   # si hubo PHP
```

### En Like UI (path symlink)

```bash
cd /home/luinux/Code/like-ui
composer update luinuxscl/lnx-ui   # solo si cambió composer.json del paquete o lock
npm install                        # si el paquete añadió deps npm nuevas
npm run build
php artisan test --filter=Biblioteca   # o el test que cubra el borrador
```

### En crm-app (cuando participó en la preview)

```bash
cd /home/luinux/Code/crm-app
composer update luinuxscl/lnx-ui
npm install && npm run build
php artisan test   # acota con --filter si la suite es pesada
```

### Tras publicar paquete

Usa la skill `lnx-ui-release` y actualiza **explícitamente** cada app que el usuario liste (Like UI en path puede quedar en `dev-develop`; crm-app y lnx suelen ir por tag `^x.y`).

### Tailwind 4

En cada app consumidora, `@source` del vendor debe incluir vistas (y JS si aplica) de `luinuxscl/lnx-ui`; tras añadir clases nuevas en el paquete, **rebuild frontend** en esa app.

## Decisiones rápidas

| Situación | Dónde previsualizar |
| --- | --- |
| Componente nuevo genérico | Borrador Like UI → galería lnx-ui |
| Kanban, tablas, cards en pipeline CRM | Like UI + luego pantalla CRM con datos demo |
| Solo copy/variantes de texto | Borrador Like UI basta |
| Shell Livewire con estado servidor | Pieza en lnx-ui; shell en app (CRM o Like UI) |

## Skills relacionadas

- `create-ui-component` — ficha previa, contrato visual, aprobación en galería.
- `lnx-ui-release` — tag, merge y actualización de consumidores.

## Checklist de cierre

- [ ] Borrador retirado o vacío en Like UI tras mover al paquete
- [ ] Snippet `.blade.txt` y categoría de galería con ancla `#nombre`
- [ ] Pest en lnx-ui verde
- [ ] `npm run build` en apps donde se previsualizó
- [ ] Composer alineado (path o versión) en Like UI y, si aplica, crm-app
- [ ] Usuario vio el resultado en borrador y/o en CRM según pidió
