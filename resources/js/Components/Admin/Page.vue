<script setup>
defineProps(['page']);
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="grid grid-cols-2">
                <div>
                    <h6 class="text-xl font-normal leading-normal mt-0 mb-2 text-emerald-800">
                        Page name: {{ page.name }}
                    </h6>
                    <h6 class="text-xl font-normal leading-normal mt-0 mb-2 text-emerald-800">
                        Slug: {{ page.slug }}
                    </h6>
                    <div>
                        <small class="font-normal leading-normal mt-0 mb-4 text-blueGray-800">
                            Menu item: {{ page.menu_item.name }}
                        </small>
                    </div>
                    <div>
                        <small class="font-normal leading-normal mt-0 mb-4 text-blueGray-800">
                            Page Category: {{ page.page_category_id }}
                        </small>
                    </div>
                </div>
                <div>
                    <div style="float:right">
                        <Link :href="route('admin.page-update-form', page.id)" method="get">
                            <button
                                class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Edit
                            </button>
                        </Link>
                        <Link :href="route('admin.post-destroy', page.id)" method="delete" as="button">
                            <button
                                class="bg-orange-500 text-white active:bg-orange-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Delete
                            </button>
                        </Link>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <p class="head mt-3">Description</p>
                <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800 text-justify"
                   v-html='page.description'/>
                <p class="head">Content</p>
                <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800 text-justify" v-html='page.content'/>
            </div>
        </div>
    </div>
</template>
