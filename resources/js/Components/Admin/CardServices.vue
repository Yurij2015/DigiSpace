<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import {sanitizeUrl} from "@braintree/sanitize-url";

const props = defineProps(['page_title', 'services']);
</script>
<template>
    <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex">
                    <h3 class="font-semibold text-base font-bold text-blueGray-700 flex-1">
                        {{ page_title }}
                    </h3>
                    <Link :href="route('admin.service-form')"
                          class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 float-right"
                          type="button">
                        Add service
                    </Link>
                    <Link :href="route('admin.service-categories')"
                          class="bg-orange-400 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 float-right"
                          type="button">
                        Service Categories
                    </Link>
                </div>
                <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                </div>
            </div>
        </div>
        <div class="block w-full overflow-x-auto">
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                <tr>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        id
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Service name
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Image
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        SEO title
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Status
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Price
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Operation
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="(item, key) in services">
                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                        {{ item.id }}
                    </th>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.title }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.image}}
                        <img :src="item.image" width="200" v-if="item.image" :alt="item.image_alt" />
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.seo_title }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.status }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.price }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        <Link :href="sanitizeUrl(route('admin.service-show', item.slug))" :title="item.title">
                            <button
                                class="bg-teal-500 text-white active:bg-teal-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Show
                            </button>
                        </Link>
                        <Link :href="sanitizeUrl(route('admin.service-update-form', item.slug))" :title="item.title">
                            <button
                                class="bg-orange-500 text-white active:bg-teal-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Edit
                            </button>
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
