<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';
import WidgetAdmin from "@/Components/Admin/WidgetAdmin.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps(['widgets']);
</script>

<template>
    <Head><title>Widgets | Admin Panel</title></Head>
    <div>
        <Sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Widgets</h6>
                            <Link :href="route('admin.widget-form')"
                                  class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                  type="button">
                                Create
                            </Link>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <WidgetAdmin
                                    v-for="widget in widgets.data"
                                    :key="widget.id"
                                    :widget="widget"
                                    :page = "widgets.current_page"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <Pagination class="mt-6" :links="widgets.links"/>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
