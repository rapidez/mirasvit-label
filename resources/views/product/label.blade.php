@foreach($product->mirasvit_label as $label)
    @if($label->prod_title)
        <span
            style="{{ $label->prod_style }}"
            @class([
                'absolute transform',
                'top-0' => str($label->prod_position)->contains('top'),
                'bottom-0' => str($label->prod_position)->contains('bottom'),
                'right-0' => str($label->prod_position)->contains('right'),
                'left-0' => str($label->prod_position)->contains('left'),
                'top-1/2 -translate-y-1/2' => str($label->prod_position)->contains('middle'),
                'right-1/2 -translate-x-1/2' => str($label->prod_position)->contains('center'),
            ])
        >
            {{ $label->prod_title }}
        </span>
    @endif
@endforeach