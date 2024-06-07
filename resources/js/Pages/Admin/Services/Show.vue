<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps(['service']);
</script>

<template>
    <Head>
        <title>Service - {{ service.title }} | Admin Panel</title>
    </Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Service - {{ service.title }}</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <div class="py-6 px-0">
                                    <div class="flex-1">
                                        <div class="flex justify-center">
                                            <div class="w-10/12 sm:w-10/12">
                                                <table class="w-full table-hover">
                                                    <tbody>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 w-3/12">
                                                            Name of service
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2 w-9/12">
                                                            {{ service.title }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 w-3/12">
                                                            Status
                                                        </th>
                                                        <td class="border border-blueGray-300 text-blue-700 font-bold px-5 py-2 w-9/12 bg-red-200">
                                                            {{ service.status }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Details
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5">
                                                            {{ service.details }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Price
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5">
                                                            {{ service.price }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Description
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2"
                                                            v-html="service.description"
                                                        />
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Service category
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2">
                                                            {{
                                                                service.service_category ? service.service_category.name : 'No category'
                                                            }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Keywords
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2">
                                                            {{ service.seo_keywords }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            SEO description
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2">
                                                            {{ service.seo_description }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            SEO Title
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2">
                                                            {{ service.seo_title }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Image alt
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2">
                                                            {{ service.image_alt }}
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Image
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2">
                                                            {{ service.image }}
                                                            <img :src="'/uploads/' + service.image" width="400" :alt="service.title"/>
                                                        </td>
                                                    </tr>
                                                    <tr class="hover:bg-sky-100">
                                                        <th class="border border-blueGray-300 text-left px-5 py-2">
                                                            Slug
                                                        </th>
                                                        <td class="border border-blueGray-300 px-5 py-2">
                                                            {{ service.slug }}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="w-2/12 sm:w-2/12 text-right">
                                                <Link :href="route('admin.service-update', service.id)"
                                                      method="get">
                                                    <button
                                                        class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                        type="button">
                                                        Edit
                                                    </button>
                                                </Link>
                                                <Link :href="route('admin.service-destroy', service.id)"
                                                      method="delete" as="button">
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
                                <Link :href="route('admin.services')">
                                    <button
                                        class="bg-emerald-700 text-white active:bg-emerald-800 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        Back
                                    </button>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
