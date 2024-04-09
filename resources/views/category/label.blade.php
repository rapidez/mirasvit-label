<span
    v-for="label in item.mirasvit_label"
    v-if="label.cat_title"
    v-bind:style="label.cat_style"
    class="absolute transform"
    :class="{
        'top-0': label.cat_position.includes('top'),
        'bottom-0': label.cat_position.includes('bottom'),
        'right-0': label.cat_position.includes('right'),
        'left-0': label.cat_position.includes('left'),
        'top-1/2 -translate-y-1/2': label.cat_position.includes('middle'),
        'right-1/2 -translate-x-1/2': label.cat_position.includes('center')
    }"
>
    @{{ label.cat_title }}
</span>
