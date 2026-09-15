<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/vue3';

const props = defineProps(['href', 'active', 'icon']);

const classes = computed(() => props.active
    ? 'text-emerald-600 bg-emerald-50 hover:text-emerald-700'
    : 'text-blueGray-700 hover:text-blueGray-500 hover:bg-blueGray-50'
);

const iconClasses = computed(() => props.active
    ? 'opacity-75'
    : 'text-blueGray-300'
);

const icon = computed(() => props.icon);

</script>

<template>
    <Link :href="href" :class="classes" class="text-xs uppercase px-3 py-2 rounded-md font-bold block transition-colors duration-150">
        <i
            :class="[icon, iconClasses]"
        ></i>
        <slot/>
    </Link>
</template>
