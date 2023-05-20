<script setup>
const props = defineProps(['post']);
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>

    <div class="flex flex-wrap">
        <div class="w-9/12 px-4">
            <span class="text-sm block my-4 p-3 text-blueGray-700 rounded border border-solid border-blueGray-100">
                <div>
                    <h6 class="text-xl font-normal leading-normal mt-0 mb-2 text-emerald-800">
                        {{ post.name }}
                    </h6>
                    <small class="font-normal leading-normal mt-0 mb-4 text-blueGray-800">
                        Category: {{ post.category.name }}
                    </small>
                    <small class="text-red-500 font-normal leading-normal mt-0 mb-4">
                        Slug: {{ post.slug ? post.slug : 'no slug' }}
                    </small>
                    <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800" v-html='post.content'/>
                </div>
            </span>
        </div>
        <div class="w-3/12 px-4">
            <span class="text-sm block my-4 p-3 text-blueGray-700 rounded border border-solid border-blueGray-100">
                <div class="justify-center">
                        <div>
                            <img :src="post.img_path" alt="..."
                                 class="shadow rounded max-w-full h-auto align-middle border-none"/>
                        </div>
                        <div class="mt-5">
                            <Link :href="route('admin.post-update', post.id)" method="get">
                                <button
                                    class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">
                                    Edit
                                </button>
                            </Link>
                            <Link :href="route('admin.post-destroy', post.id)" method="delete" as="button">
                                <button
                                    class="bg-orange-500 text-white active:bg-orange-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">
                                    Delete
                                </button>
                            </Link>
                        </div>
                    </div>
            </span>
        </div>
    </div>
</template>
