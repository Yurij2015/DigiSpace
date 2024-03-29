<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import SkillsMenu from "@/Pages/Admin/Portfolio/Skills/Components/SkillsMenu.vue";
import SkillTypesTable from "@/Pages/Admin/Portfolio/Skills/Components/SkillTypesTable.vue";
import SkillsLocalesTable from "@/Pages/Admin/Portfolio/Skills/Components/SkillsLocalesTable.vue";
import SkillSubcategoriesTable from "@/Pages/Admin/Portfolio/Skills/Components/SkillSubcategoriesTable.vue";
import SkillsTable from "@/Pages/Admin/Portfolio/Skills/Components/SkillsTable.vue";

defineProps(['skillTypes', 'skillLocales', 'skillSubcategories', 'skills']);

</script>

<template>
    <Head><title>Skills</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100 h-screen">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <div class="flex-1">
                                <h6 class="text-blueGray-700 text-xl font-bold uppercase text-left">Skills</h6>
                            </div>
                            <SkillsMenu/>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-3">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <SkillTypesTable :skill-types="skillTypes"/>
                            <hr class="h-px my-8 bg-gray-200 h-1 border-0 dark:bg-gray-700">
                            <SkillsLocalesTable :skill-locales="skillLocales"/>
                            <hr class="h-px my-8 bg-gray-200 h-1 border-0 dark:bg-gray-700">
                            <SkillSubcategoriesTable :skill-subcategories="skillSubcategories"/>
                            <hr class="h-px my-8 bg-gray-200 h-1 border-0 dark:bg-gray-700">
                            <SkillsTable :skills="skills"/>
                            <hr class="h-px my-8 bg-gray-200 h-1 border-0 dark:bg-gray-700">
                        </div>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
