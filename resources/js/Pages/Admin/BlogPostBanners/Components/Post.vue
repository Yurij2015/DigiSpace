<script setup>
const props = defineProps(['post']);
import {Link} from '@inertiajs/inertia-vue3';
</script>
<template>
    <div class="flex flex-wrap mb-5 mt-5">
        <div class="w-8/12 px-4">
            <div>
                <h4 class="text-xl font-normal leading-normal mt-0 mb-2 text-emerald-800">
                    {{ post.name }}
                </h4>
            </div>
        </div>
        <div class="w-2/12 px-4">
            <div v-if="post.blog_post_banner">
                <img :src="post.blog_post_banner.img_path" :alt="post.name"
                     class="shadow rounded max-w-full h-auto align-middle border-none"/>
            </div>
        </div>
        <div class="w-2/12 px-4">
            <span class="text-sm block text-blueGray-700 rounded border border-solid border-blueGray-100">
                <div class="justify-center">
                    <div v-if="!post.blog_post_banner">
                            <Link :href="route('admin.post-banner-form', post.id)" method="get">
                                <button
                                    class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-150"
                                    type="button">
                                    Add banner
                                </button>
                            </Link>
                    </div>
                    <div v-if="post.blog_post_banner">
                        <Link :href="route('admin.banner-update-form', post.blog_post_banner.id)" method="get">
                            <button
                                class="bg-orange-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-150"
                                type="button">
                                Edit banner
                            </button>
                        </Link>
                    </div>
                </div>
            </span>
        </div>
    </div>
    <hr class="border-dotted">
</template>
