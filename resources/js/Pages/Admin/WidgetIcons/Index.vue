<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';
import WidgetIconAdmin from "@/Components/Admin/WidgetIconAdmin.vue";

defineProps(['icons', 'page']);
</script>

<template>
    <Head><title>Widget icons | Admin Panel</title></Head>
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
                            <h6 class="text-blueGray-700 text-xl font-bold">
                                Icons of widget - {{ icons[0].widget.title }} with id - {{ icons[0].widget.id }}
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <WidgetIconAdmin
                                    v-for="icon in icons"
                                    :key="icon.id"
                                    :icon="icon"
                                />
                                <Link :href="route('admin.widgets')+'?page='+page">
                                    <button
                                        class="bg-orange-500 text-white active:bg-orange-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
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
