<script setup>
defineProps(['widgetMiddleRight']);
</script>
<template>
    <div
        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-emerald-400"
    >
        <i :class="widgetMiddleRight.icon" v-if="widgetMiddleRight"></i>
    </div>
    <h6 class="text-xl font-semibold" v-if="widgetMiddleRight">{{ widgetMiddleRight.title }}</h6>
    <p class="mt-2 mb-4 text-blueGray-500" v-if="widgetMiddleRight">
        {{ widgetMiddleRight.content }}
    </p>
</template>
