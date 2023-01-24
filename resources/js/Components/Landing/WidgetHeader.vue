<script setup>
defineProps(['widgetHeader']);
</script>
<template>
    <h1 class="text-white font-semibold text-5xl">
        {{ widgetHeader.title }}
    </h1>
    <div class="mt-4 text-lg text-blueGray-200">
        {{ widgetHeader.content }}
    </div>
</template>
