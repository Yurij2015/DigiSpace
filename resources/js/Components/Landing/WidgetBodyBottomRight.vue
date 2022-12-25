<script setup>
defineProps(['widgetBodyBottomRight']);
</script>
<template>
    <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
        <div class="md:pr-12">
            <div
                class="text-emerald-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-emerald-300"
            >
                <i :class="widgetBodyBottomRight.icon" class="text-xl"></i>
            </div>
            <h3 class="text-3xl font-semibold" v-if="widgetBodyBottomRight.title">{{ widgetBodyBottomRight.title }}</h3>
            <p class="mt-4 text-lg leading-relaxed text-blueGray-500" v-if="widgetBodyBottomRight.content">
                {{ widgetBodyBottomRight.content }}
            </p>
            <ul class="list-none mt-6">
                <li class="py-2">
                    <div class="flex items-center">
                        <div>
                        <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-emerald-600 bg-emerald-200 mr-3"
                        >
                          <i class="fas fa-fingerprint"></i>
                        </span>
                        </div>
                        <div>
                            <h4 class="text-blueGray-500">
                                Carefully crafted components
                            </h4>
                        </div>
                    </div>
                </li>
                <li class="py-2">
                    <div class="flex items-center">
                        <div>
                        <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-emerald-600 bg-emerald-200 mr-3"
                        >
                          <i class="fab fa-html5"></i>
                        </span>
                        </div>
                        <div>
                            <h4 class="text-blueGray-500">
                                Amazing page examples
                            </h4>
                        </div>
                    </div>
                </li>
                <li class="py-2">
                    <div class="flex items-center">
                        <div>
                        <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-emerald-600 bg-emerald-200 mr-3"
                        >
                          <i class="far fa-paper-plane"></i>
                        </span>
                        </div>
                        <div>
                            <h4 class="text-blueGray-500">Dynamic components</h4>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>


</template>
