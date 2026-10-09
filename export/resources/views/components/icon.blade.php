{{-- An icon from resources/icons: `ui/{name}` (Lucide, ISC licence) by default,
     or `brands/{name}` (Simple Icons, CC0). Decorative unless given a label. --}}
@props(['name', 'label' => null])
@php
    // Only a name from resources/icons: letters, digits and dashes.
    $name = preg_match('#^((ui|brands)/)?[a-z0-9-]+$#', (string) $name) ? $name : 'none';
    $path = resource_path('icons/'.(str_contains($name, '/') ? $name : "ui/{$name}").'.svg');
    $svg = is_file($path) ? file_get_contents($path) : '';
    $a11y = $label ? 'role="img" aria-label="'.e($label).'"' : 'aria-hidden="true" focusable="false"';
    $class = e($attributes->get('class', 'size-5'));
@endphp
{!! preg_replace('/<svg\b/', "<svg class=\"{$class} shrink-0\" {$a11y}", $svg, 1) !!}
