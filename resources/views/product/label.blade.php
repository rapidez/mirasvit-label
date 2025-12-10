@foreach(collect($product->mirasvit_labels)->sortBy('sort_order')->groupBy('viewLabel.position') as $position => $labels)
    @php([$y, $x] = str_split($position))
    <div @class([
            'absolute z-10 flex flex-col gap-1',

            'left-2.5' => $x === 'L', // Left
            'right-2.5 items-end' => $x === 'R', // Right
            'left-1/2 -translate-x-1/2' => $x === 'C', // Center (horizontally)

            'top-2.5' => $y === 'T', // Top
            'bottom-2.5' => $y === 'B', // Bottom
            'top-1/2 -translate-y-1/2' => $y === 'M', // Middle (vertically)
        ])
    >
        @foreach($labels as $label)
            @continue(!$label->viewLabel)
            <span
                style="{{ $label->viewLabel->style }}"
            >
                {{ $label->viewLabel->title }}
            </span>
        @endforeach
    </div>
@endforeach
