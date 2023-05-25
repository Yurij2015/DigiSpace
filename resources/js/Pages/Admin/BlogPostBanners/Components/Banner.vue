<script setup>
const props = defineProps(['banner']);
import {Link} from '@inertiajs/inertia-vue3';
</script>
<template>
    <div class="flex flex-wrap mb-5 mt-5">
        <div class="w-8/12 px-4">
            <div v-if="banner.post">
                <p class="text-x font-normal leading-normal mt-0 mb-2 text-emerald-800">
                    Post name: <span class="font-bold text-orange-500"> {{ banner.post.name }} </span>
                </p>
                <p class="text-x font-normal leading-normal mt-0 mb-2 text-emerald-800">
                    Banner url: <span class="font-bold text-orange-500"> {{ banner.url }} </span>
                </p>
                <p class="text-x font-normal leading-normal mt-0 mb-2 text-emerald-800">
                    Banner alt: <span class="font-bold text-orange-500"> {{ banner.alt }} </span>
                </p>
            </div>
            <div v-if="banner.blog_page_type">
                <p class="text-x font-normal leading-normal mt-0 mb-2 text-emerald-800">
                    Blog page type name: <span class="font-bold text-emerald-500"> {{ banner.blog_page_type }} </span>
                </p>
                <p class="text-x font-normal leading-normal mt-0 mb-2 text-emerald-800">
                    Banner url: <span class="font-bold text-orange-500"> {{ banner.url }} </span>
                </p>
                <p class="text-x font-normal leading-normal mt-0 mb-2 text-emerald-800">
                    Banner alt: <span class="font-bold text-orange-500"> {{ banner.alt }} </span>
                </p>
            </div>
        </div>
        <div class="w-2/12 px-4">
            <img :src="banner.img_path" :alt="banner.name"
                 class="shadow rounded max-w-full h-auto align-middle border-none"/>
        </div>
        <div class="w-2/12 px-4">
            <span class="text-sm block text-blueGray-700 rounded border border-solid border-blueGray-100">
                <div class="justify-center">
                        <Link :href="route('admin.banner-update-form', banner.id)" method="get">
                            <button
                                class="bg-orange-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-150"
                                type="button">
                                Edit banner
                            </button>
                        </Link>
                </div>
            </span>
        </div>
    </div>
    <hr class="border-solid">
</template>
