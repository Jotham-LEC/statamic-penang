{{-- Table: rows and columns from the editor (a comparison, a price list,
     delivery areas), the first row as headings if chosen, and the first
     column naming each row. Scrolls sideways on a narrow screen. --}}
@php
    $rows = collect($block->table ?? [])
        ->map(fn ($row) => array_map(fn ($cell) => trim((string) $cell), $row['cells'] ?? []))
        ->filter(fn ($cells) => collect($cells)->filter()->isNotEmpty())
        ->values();
    $head = $block->header_row !== false && $rows->count() > 1 ? $rows->shift() : null;
    $rowHeads = (bool) $block->header_column;
@endphp
@if ($rows->isNotEmpty())
    <x-section :block="$block">
        <x-section-heading :eyebrow="$block->eyebrow" :heading="$block->heading" :intro="$block->intro" />
        <div
            @class(['border-border overflow-x-auto rounded-lg border', 'mt-10' => filled((string) $block->heading) || filled((string) $block->intro)])
            tabindex="0"
            role="region"
            aria-label="{{ (string) $block->heading ?: __('Table') }}"
        >
            <table class="w-full text-left text-sm sm:text-base">
                @if (filled((string) $block->caption))
                    <caption class="text-muted-foreground caption-bottom px-4 py-3 text-left text-sm">
                        {{ $block->caption }}
                    </caption>
                @endif
                @if ($head)
                    <thead class="bg-muted">
                        <tr>
                            @foreach ($head as $cell)
                                <th scope="col" class="px-4 py-3 font-semibold whitespace-nowrap">{{ $cell }}</th>
                            @endforeach
                        </tr>
                    </thead>
                @endif
                <tbody class="divide-border divide-y">
                    @foreach ($rows as $cells)
                        <tr>
                            @foreach ($cells as $cell)
                                @if ($loop->first && $rowHeads)
                                    <th scope="row" class="px-4 py-3 font-semibold">{{ $cell }}</th>
                                @else
                                    <td class="text-muted-foreground px-4 py-3">{{ $cell }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-section>
@endif
