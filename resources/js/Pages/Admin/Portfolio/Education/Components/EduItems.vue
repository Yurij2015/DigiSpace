<script setup>
import EduItemPlaces from "@/Pages/Admin/Portfolio/Education/Components/EduItemPlaces.vue";
import EduItemLocales from "@/Pages/Admin/Portfolio/Education/Components/EduItemLocales.vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps(['eduItem', 'education']);
</script>
<template>
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex flex-wrap">
                    <div class="flex-1">
                        <h3 class="font-semibold text-base text-blueGray-700">
                            {{ eduItem.name }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="block w-full overflow-x-auto">
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                <tr>
                    <th class="px-4 bg-blueGray-50 text-blueGray-600 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0  font-bold text-center">
                        #
                    </th>
                    <th class="px-4 bg-blueGray-50 text-blueGray-600 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0  font-bold text-center">
                        name
                    </th>
                    <th class="px-4 bg-blueGray-50 text-blueGray-800 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0  font-bold text-center">
                        locales
                    </th>
                    <th class="px-4 bg-blueGray-50 text-blueGray-800 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0  font-bold text-center">
                        period
                    </th>
                    <th class="px-4 bg-blueGray-50 text-blueGray-800 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0  font-bold text-center">
                        place
                    </th>
                    <th class="px-4 bg-blueGray-50 text-blueGray-800 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0  font-bold text-center">
                        Operation
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-x  p-4 text-center">
                        {{ eduItem.id }}
                    </th>

                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-x  p-4 text-center">
                        {{ eduItem.name }}
                    </th>
                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-x  p-4 text-left">
                        <EduItemLocales v-for="eduItemLocale in eduItem.pf_education_item_locale"
                                        :key="eduItemLocale.id"
                                        :edu-item-locale="eduItemLocale">
                        </EduItemLocales>
                    </th>
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs  p-4">
                        <!--                        <p v-for="date in JSON.parse(eduItem.period)">-->
                        {{ eduItem.period }}
                        <!--                        </p>-->
                    </td>
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs  p-4">
                        <EduItemPlaces v-for="eduItemPlace in eduItem.pf_education_item_place"
                                       :key="eduItemPlace.id"
                                       :edu-item-place="eduItemPlace">
                        </EduItemPlaces>
                    </td>
                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs  p-4 text-center">
                        <Link :href="route('portfolio.edu-item-edit', eduItem.id)" method="get">
                            <button
                                class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
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
<style scoped>
</style>
