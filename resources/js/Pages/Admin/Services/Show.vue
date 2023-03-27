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
                                <div class="p-6 flex space-x-2">
                                    <div class="flex-1">
                                        <div class="grid grid-cols-0">
                                            <div class="flex flex-wrap justify-center">
                                                <div class="w-9/12 sm:w-9/12">
                                                    <h6 class="text-xl font-normal leading-normal mt-0 mb-2 text-emerald-800">
                                                        Name of service: {{ service.title }}
                                                    </h6>
                                                    <small
                                                        class="font-normal leading-normal mt-0 mb-4 text-blueGray-800">
                                                        Details: {{ service.details }}
                                                    </small>
                                                    <div class="font-normal leading-normal mt-0 text-blueGray-800">
                                                        Icon: {{ service.price }}
                                                    </div>
                                                </div>

                                                <div class="w-2/12 sm:w-2/12">
                                                    <div style="float:right">
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
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
