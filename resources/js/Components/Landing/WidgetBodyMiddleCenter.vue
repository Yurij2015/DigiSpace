<script setup>
defineProps(['widgetBodyMiddleCenter']);
</script>
<template>
    <div class="w-full md:w-6/12 lg:w-3/12 lg:mb-0 mb-12 px-4" v-for="item in widgetBodyMiddleCenter">
        <div class="px-6">
            <img
                alt="..."
                :src="item.widget_image"
                class="shadow-lg rounded-full mx-auto max-w-120-px"
            />
            <div class="pt-6 text-center">
                <h5 class="text-xl font-bold">{{ item.title }}</h5>
                <p
                    class="mt-1 text-sm text-blueGray-400 uppercase font-semibold" v-html="item.content"
                >
                </p>
                <div class="mt-6">
                    <button
                        class="bg-pink-500 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                        type="button"
                    >
                        <i class="fab fa-dribbble"></i>
                    </button>
                    <button
                        class="bg-red-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                        type="button"
                    >
                        <i class="fab fa-google"></i>
                    </button>
                    <button
                        class="bg-lightBlue-400 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                        type="button"
                    >
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button
                        class="bg-blueGray-700 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                        type="button"
                    >
                        <i class="fab fa-instagram"></i>
                    </button>
                    <button
                        class="bg-lightBlue-600 text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                        type="button"
                    >
                        <i class="fab fa-facebook-f"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
