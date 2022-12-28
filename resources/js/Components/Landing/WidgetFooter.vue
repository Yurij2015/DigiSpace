<script setup>
defineProps(['widgetFooter']);
</script>
<template>
    <h4 class="text-3xl font-semibold">{{ widgetFooter.title }}</h4>
    <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
        {{ widgetFooter.content }}
    </h5>
    <div class="mt-6 lg:mb-0 mb-6">
        <button
            class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
            type="button"
        >
            <i class="fab fa-twitter"></i>
        </button>
        <button
            class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
            type="button"
        >
            <i class="fab fa-facebook-square"></i>
        </button>
        <button
            class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
            type="button"
        >
            <i class="fab fa-dribbble"></i>
        </button>
        <button
            class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
            type="button"
        >
            <i class="fab fa-github"></i>
        </button>
    </div>
</template>
