<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';
import Page from "@/Components/Admin/Page.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps(['pages']);
let pageTitle = "Pages";
</script>

<template>
    <Head><title>Pages | Admin Panel</title></Head>
    <sidebar/>
    <div class="relative md:ml-64 bg-blueGray-100">
        <AdminNavbar/>
        <HeaderStats/>
        <div class="px-4 md:px-10 mx-auto w-full -m-24">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">Pages</h6>
                        <Link :href="route('admin.page-form')"
                              class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                              type="button">
                            Create page
                        </Link>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                    <div class="flex flex-wrap">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <Page
                                v-for="page in pages.data"
                                :key="page.id"
                                :page="page"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <Pagination class="mt-6" :links="pages.links"/>
            <FooterAdmin/>
        </div>
    </div>
</template>
