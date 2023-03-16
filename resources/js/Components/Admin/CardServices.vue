<script setup>
import {Link} from '@inertiajs/inertia-vue3';

const props = defineProps(['page_title', 'services']);
</script>
<template>
    <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-base text-blueGray-700">
                        {{ page_title }}
                    </h3>
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
                        #
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Service name
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Operation
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="(item, key) in services">
                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                        {{ key+1 }}
                    </th>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.title }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        <Link :href="route('admin.service-show', item.id)" :title="item.title">
                            <button
                                class="bg-teal-500 text-white active:bg-teal-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                                Show
                            </button>
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
