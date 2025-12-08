<template v-for="(labels, position) in Object.groupBy(Object.values(item.mirasvit_labels ? item.mirasvit_labels : {}), (element) => element.position)">
    <div class="absolute z-10 flex flex-col gap-1" :class="{
        'left-1': position[1] === 'L', // Left
        'right-1 items-end': position[1] === 'R', // Right
        'left-1/2 -translate-x-1/2': position[1] === 'C', // Center (horizontally)

        'top-1': position[0] === 'T', // Top
        'bottom-1': position[0] === 'B', // Bottom
        'top-1/2 -translate-y-1/2': position[0] === 'M', // Middle (vertically)
    }">
        <div
            v-for="label in labels.filter(label => label.title)"
            class="relative"
            v-bind:style="label.style"
        >
            <span>
                @{{ label.title }}
            </span>
        </div>
    </div>
</template>
