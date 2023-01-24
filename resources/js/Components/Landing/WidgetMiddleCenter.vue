<script setup>
defineProps(['widgetMiddleCenter']);
</script>
<template>
    <div
        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-lightBlue-400"
    >
        <i :class="widgetMiddleCenter.icon"></i>
    </div>
    <h6 class="text-xl font-semibold">{{ widgetMiddleCenter.title }}</h6>
    <p class="mt-2 mb-4 text-blueGray-500">
        {{ widgetMiddleCenter.content }}
    </p>
</template>


