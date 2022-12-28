<script setup>
defineProps(['widgetBodyBottomMiddle']);
</script>
<template>
    <div class="flex flex-wrap mt-12 justify-center">
        <div class="w-full lg:w-3/12 px-4 text-center" v-for="item in widgetBodyBottomMiddle">
            <div
                class="text-blueGray-800 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
            >
                <i class="text-xl" :class="item.icon"></i>
            </div>
            <h6 class="text-xl mt-5 font-semibold text-white">
                {{ item.title }}
            </h6>
            <p class="mt-2 mb-4 text-blueGray-400">
                {{ item.content }}
            </p>
        </div>
    </div>
</template>
