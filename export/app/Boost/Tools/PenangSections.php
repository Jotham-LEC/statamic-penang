<?php

namespace App\Boost\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;
use Statamic\Facades\Fieldset;

/**
 * A Laravel Boost tool for Penang: the page builder's sections (the sets of the `blocks`
 * Replicator in resources/fieldsets/page_builder.yaml), by set picker group, with their layouts,
 * fields and views. It reads only.
 */
#[IsReadOnly]
class PenangSections extends Tool
{
    protected string $description = 'List the sections of Penang\'s page builder (the sets of the `blocks` field in resources/fieldsets/page_builder.yaml), by set picker group (Hero sections, Feature sections…): each one\'s handle, name, hint, layouts, fields and Blade view in resources/views/components/blocks/. Give a `section` handle for its full field configuration. Use it before changing a section or adding one, and to write page content (entries\' `blocks`) with the right field handles.';

    public function schema(JsonSchema $schema): array
    {
        return [
            'section' => $schema->string()->description('A section\'s handle (such as "hero" or "feature_grid") for its full field configuration.'),
        ];
    }

    public function handle(Request $request): Response
    {
        $groups = collect(Fieldset::find('page_builder')?->contents()['fields'][0]['field']['sets'] ?? []);
        $sets = $groups->flatMap(fn ($group) => $group['sets'] ?? []);
        $groupOf = $groups->flatMap(fn ($group, $key) => array_fill_keys(array_keys($group['sets'] ?? []), $key));
        $view = fn (string $handle) => 'resources/views/components/blocks/'.str_replace('_', '-', $handle).'.blade.php';

        if ($handle = (string) $request->get('section')) {
            $set = $sets->get($handle);

            return $set
                ? Response::json(['handle' => $handle, 'group' => $groupOf->get($handle), 'view' => $view($handle), 'view_exists' => is_file(base_path($view($handle))), ...$set])
                : Response::error("No section [{$handle}]. Sections: ".$sets->keys()->implode(', ').'.');
        }

        return Response::json($groups->map(fn ($group, $key) => [
            'group' => $key,
            'name' => $group['display'] ?? $key,
            'description' => $group['instructions'] ?? null,
            'icon' => $group['icon'] ?? null,
            'sections' => collect($group['sets'] ?? [])->map(fn ($set, $handle) => [
                'handle' => $handle,
                'name' => $set['display'] ?? $handle,
                'description' => $set['instructions'] ?? null,
                'layouts' => collect($set['fields'] ?? [])->firstWhere('handle', 'layout')['field']['options'] ?? null,
                'fields' => collect($set['fields'] ?? [])->map(fn ($field) => isset($field['import']) ? 'import: '.$field['import'] : $field['handle'].' ('.($field['field']['type'] ?? $field['field'] ?? '?').')')->values()->all(),
                'view' => $view($handle),
            ])->values()->all(),
        ])->values()->all());
    }
}
