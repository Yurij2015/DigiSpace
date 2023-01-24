<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active', 'icon']);

const classes = computed(() => props.active
    ? 'text-emerald-500 hover:text-emerald-600'
    : 'text-blueGray-700 hover:text-blueGray-500'
);

const iconClasses = computed(() => props.active
    ? 'opacity-75'
    : 'text-blueGray-300'
);

const icon = computed(() => props.icon);

</script>

<template>
    <Link :href="href" :class="classes" class="text-xs uppercase py-3 font-bold block">
        <i
            :class="[icon, iconClasses]"
        ></i>
        <slot/>
    </Link>
</template>
