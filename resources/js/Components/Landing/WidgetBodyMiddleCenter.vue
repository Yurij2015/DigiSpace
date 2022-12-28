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
                    <button v-for="icon in item.widget_icon"
                            class="text-white w-8 h-8 rounded-full outline-none focus:outline-none mr-1 mb-1"
                            :class="icon.css_class"
                            type="button"
                    >
                        <i :class="icon.icon_class"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
