<script setup>
defineProps(['widgetBodyTopSecondLeft']);
</script>
<template>
    <div class="w-full md:w-4/12 ml-auto mr-auto px-4">
        <img
            :alt="widgetBodyTopSecondLeft.title"
            class="max-w-full rounded-lg shadow-lg"
            :src="widgetBodyTopSecondLeft.widget_image"
        />
    </div>
</template>
