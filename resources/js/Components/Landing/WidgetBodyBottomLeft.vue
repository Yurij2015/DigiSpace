<script setup>
defineProps(['widgetBodyBottomLeft']);
</script>
<template>
    <div class="w-full md:w-4/12 ml-auto mr-auto px-4">
        <img
            :alt="widgetBodyBottomLeft.title"
            class="max-w-full rounded-lg shadow-lg"
            :src="widgetBodyBottomLeft.widget_image"
        />
    </div>
</template>
