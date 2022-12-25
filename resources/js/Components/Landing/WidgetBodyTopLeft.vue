<script setup>
import {Link} from '@inertiajs/inertia-vue3';

defineProps(['widgetBodyTopLeft']);
</script>
<template>
    <div
        class="text-blueGray-500 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-white"
    >
        <i :class="widgetBodyTopLeft.icon" class="text-xl" v-if="widgetBodyTopLeft"></i>
    </div>
    <h3 class="text-3xl mb-2 font-semibold leading-normal" v-if="widgetBodyTopLeft">{{ widgetBodyTopLeft.title }}</h3>
    <div v-if="widgetBodyTopLeft" v-html="widgetBodyTopLeft.content">
    </div>
    <Link to="/" class="font-bold text-blueGray-700 mt-8">
        {{ widgetBodyTopLeft.subtitle }}
    </Link>
</template>
