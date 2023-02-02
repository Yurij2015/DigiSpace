<script setup>
defineProps(['icon']);

import {Link} from '@inertiajs/inertia-vue3';
</script>
<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="grid grid-cols-0">
                <div class="flex flex-wrap justify-center">
                    <div class="w-9/12 sm:w-9/12">
                        <div class="font-normal leading-normal mt-0 text-blueGray-800">
                            Icon css class: {{ icon.icon_class }}
                        </div>
                        <div class="font-normal leading-normal mt-0 text-blueGray-800">
                            Icon description: {{ icon.description }}
                        </div>
                        <div class="font-normal leading-normal mt-0 text-blueGray-800">
                            Icon url: {{ icon.url }}
                        </div>
                        <div class="font-normal leading-normal mt-0 text-blueGray-800">
                            Css class: {{ icon.css_class }}
                        </div>
                    </div>
                    <div class="w-2/12 sm:w-2/12">
                        <div style="float:right">
                            <Link :href="route('admin.widget-update', icon.id)" method="get">
                                <button
                                    class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">
                                    Edit
                                </button>
                            </Link>
                            <Link :href="route('admin.widget-destroy', icon.id)" method="delete" as="button" v-show="false">
                                <button
                                    class="bg-orange-500 text-white active:bg-orange-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">
                                    Delete
                                </button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
