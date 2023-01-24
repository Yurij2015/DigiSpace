<script setup>
defineProps(['widgetBodyMiddleTop']);
</script>
<template>
    <div class="w-full lg:w-6/12 px-4">
        <h2 class="text-4xl font-semibold">{{ widgetBodyMiddleTop.title }}</h2>
        <p class="text-lg leading-relaxed m-4 text-blueGray-500">
            {{ widgetBodyMiddleTop.content }}
        </p>
    </div>
</template>
