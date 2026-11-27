@props(['name'])

{{--
    Resuelve un logo de marca vendorizado (logos de integraciones/proveedores,
    nunca iconografía de interfaz). El consumidor fija tamaño con `class="size-6"`;
    los logos multicolor no se recolorean y los monocromos heredan `currentColor`.
    Nombre en kebab-case: `<x-lnx-ui::brand-logo name="google-calendar" class="size-6" />`.
--}}
<x-dynamic-component :component="'lnx-ui::brand-logos.'.$name" {{ $attributes }} />
