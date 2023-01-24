<script setup>
defineProps(['widgetMiddleLeft']);
</script>
<template>
    <div
        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400"
    >
        <i :class="widgetMiddleLeft.icon"></i>
    </div>
    <h6 class="text-xl font-semibold">{{ widgetMiddleLeft.title }}</h6>
    <p class="mt-2 mb-4 text-blueGray-500">
        {{ widgetMiddleLeft.content }}
    </p>
</template>
