<script setup>
defineProps(['widgetHeader']);

</script>
<template>
    <h1 class="text-white font-semibold text-5xl">
        <span v-if="!widgetHeader">Your story starts with us</span>
        <span v-if="widgetHeader">{{ widgetHeader.title }}</span>
    </h1>
    <div class="mt-4 text-lg text-blueGray-200">
        <div v-if="!widgetHeader">This is a simple example of a Landing Page you can build using
            Vue Notus. It features multiple CSS components based on the
            Tailwind CSS design system.
        </div>
        <div v-if="widgetHeader">{{ widgetHeader.content }}</div>
    </div>
</template>
