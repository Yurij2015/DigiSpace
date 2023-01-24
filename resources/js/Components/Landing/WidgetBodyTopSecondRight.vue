<script setup>
defineProps(['widgetBodyTopSecondRight']);
</script>
<template>
    <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
        <div class="md:pr-12">
            <div
                class="text-emerald-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-emerald-300"
            >
                <i :class="widgetBodyTopSecondRight.icon" class="text-xl"></i>
            </div>
            <h3 class="text-3xl font-semibold">{{ widgetBodyTopSecondRight.title }}</h3>
            <p class="mt-4 text-lg leading-relaxed text-blueGray-500">
                {{ widgetBodyTopSecondRight.content }}
            </p>
            <ul class="list-none mt-6">
                <li class="py-2" v-for="icon in widgetBodyTopSecondRight.widget_icon">
                    <div class="flex items-center">
                        <div>
                            <span
                                class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-emerald-600 bg-emerald-200 mr-3"
                            >
                                <i :class="icon.icon_class"></i>
                            </span>
                        </div>
                        <div>
                            <h4 class="text-blueGray-500">
                                {{ icon.description }}
                            </h4>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
