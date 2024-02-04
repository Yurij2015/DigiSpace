<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import EduItems from "@/Pages/Admin/Portfolio/Education/Components/EduItems.vue";
import EduInfoLocales from "@/Pages/Admin/Portfolio/Education/Components/EduInfoLocales.vue";

defineProps(['education']);

</script>

<template>
    <Head><title>Education</title></Head>
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
                            <div class="flex-1">
                                <h6 class="text-blueGray-700 text-xl font-bold uppercase text-left">{{ education.name }}</h6>
                            </div>
                            <div class="flex-1">
                                <Link :href="route('portfolio.education-item-create')"
                                      class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 float-right"
                                      type="button">
                                    Add education item
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-3">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <EduInfoLocales v-for="eduInfoLocale in education.pf_education_info_locale"
                                            :key="eduInfoLocale.id"
                                            :edu-info-locale="eduInfoLocale">
                            </EduInfoLocales>
                            <EduItems v-for="eduItem in education.pf_education_item"
                                      :key="eduItem.id"
                                      :edu-item="eduItem"
                                      :education="education">
                            </EduItems>
                        </div>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
