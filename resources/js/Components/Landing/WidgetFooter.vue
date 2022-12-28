<script setup>
defineProps(['widgetFooter']);
</script>
<template>
    <h4 class="text-3xl font-semibold">{{ widgetFooter.title }}</h4>
    <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
        {{ widgetFooter.content }}
    </h5>
    <div class="mt-6 lg:mb-0 mb-6">
        <button v-for="icon in widgetFooter.widget_icon"
                class="bg-white shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                type="button"
                :class="icon.css_class"
        >
            <i :class="icon.icon_class"></i>
        </button>
    </div>
</template>
