<script setup>
defineProps(['widget']);
import {Link} from '@inertiajs/inertia-vue3';
</script>
<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="grid grid-cols-0">
                <div class="flex flex-wrap justify-center">
                    <div class="w-9/12 sm:w-9/12">
                        <h6 class="text-xl font-normal leading-normal mt-0 mb-2 text-emerald-800">
                            {{ widget.title }}
                        </h6>
                        <small class="font-normal leading-normal mt-0 mb-4 text-blueGray-800">
                            Category: {{ widget.widget_category.title }}

                        </small>
                        <div class="font-normal leading-normal mt-0 text-blueGray-800" v-if="widget.icon">
                            Icon: {{ widget.icon }}
                        </div>
                        <div class="font-normal leading-normal mt-0 text-blueGray-800">
                            Subtitle: {{ widget.subtitle }}
                        </div>
                        <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800"
                           v-html='widget.content'/>
                    </div>
                    <div class="w-1/12 sm:w-1/12">
                        <img :src="widget.widget_image" alt="..."
                             class="shadow rounded max-w-full h-auto align-middle border-none"/>
                    </div>
                    <div class="w-2/12 sm:w-2/12">
                        <div style="float:right">
                            <Link :href="route('admin.widget-update', widget.id)" method="get">
                                <button
                                    class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">
                                    Edit
                                </button>
                            </Link>
                            <Link :href="route('admin.widget-destroy', widget.id)" method="delete" as="button">
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
