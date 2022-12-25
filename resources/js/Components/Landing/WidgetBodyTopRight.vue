<script setup>
defineProps(['widgetBodyTopRight']);
</script>
<template>
    <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-emerald-500"
    >
        <img
            :alt="widgetBodyTopRight.title"
            :src="widgetBodyTopRight.widget_image"
            class="w-full align-middle rounded-t-lg"
        />
        <blockquote class="relative p-8 mb-4">
            <svg
                preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 583 95"
                class="absolute left-0 w-full block h-95-px -top-94-px"
            >
                <polygon
                    points="-30,95 583,95 583,65"
                    class="text-emerald-500 fill-current"
                ></polygon>
            </svg>
            <h4 class="text-xl font-bold text-white" v-if="widgetBodyTopRight">
                {{ widgetBodyTopRight.title }}
            </h4>
            <p class="text-md font-light mt-2 text-white" v-if="widgetBodyTopRight">
                {{ widgetBodyTopRight.content }}
            </p>
        </blockquote>
    </div>


</template>
