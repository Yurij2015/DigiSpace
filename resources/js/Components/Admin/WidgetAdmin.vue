<script setup>
defineProps(['widget', 'page']);

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

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
                        <p v-if="!isJson(widget.content)"
                           class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800"
                           v-html='widget.content'></p>
                        <p v-else
                           class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800 json-content"
                           v-html='widget.content'></p>
                        <div v-if="widget.widget_icon.length">
                            <span class="text-red-600 font-bold">Icons: </span>
                            <span class="text-red-400" v-for="(value, key) of widget.widget_icon"> {{
                                    value.icon_class
                                }}
                                <span v-if="key+1 < widget.widget_icon.length"> | </span>
                            </span>
                            <Link :href="route('admin.widget-icons', widget.id)+'?page='+page" method="get">
                                <button
                                    class="bg-teal-500 text-white active:bg-teal-600 text-xs px-2 py-1 rounded shadow hover:shadow-md outline-none focus:outline-none ml-1 ease-linear transition-all duration-150">
                                    View icons
                                </button>
                            </Link>
                        </div>
                    </div>
                    <div class="w-1/12 sm:w-1/12">
                        <img :src="widget.widget_image" alt="..."
                             class="shadow rounded max-w-full h-auto align-middle border-none"/>
                    </div>
                    <div class="w-2/12 sm:w-2/12">
                        <div style="float:right">
                            <Link :href="route('admin.widget-update-form', widget.id)+'?page='+page" method="get">
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
<style>
.json-content {
    border: dotted 1px;
    background: #f6f6bd;
}

</style>
