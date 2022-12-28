<script setup>
defineProps(['widgetBodyBottomTop']);
</script>
<template>
    <div class="flex flex-wrap text-center justify-center">
        <div class="w-full lg:w-6/12 px-4">
            <h2 class="text-4xl font-semibold text-white">
                {{ widgetBodyBottomTop.title }}
            </h2>
            <p class="text-lg leading-relaxed mt-4 mb-4 text-blueGray-400">
                {{ widgetBodyBottomTop.content }}
            </p>
        </div>
    </div>
</template>
