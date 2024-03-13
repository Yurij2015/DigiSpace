<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import SectionMenu from "@/Pages/Admin/Portfolio/Sections/Components/SectionMenu.vue";
import Sections from "@/Pages/Admin/Portfolio/Sections/Components/Sections.vue";
import {ref, shallowRef} from "vue";

defineProps(['sections', 'subcategories', 'places', 'sectionItems']);

const receivedData = ref('');
const dynamicComponentName = shallowRef('');

const showModal = (data) => {
    receivedData.value = data;
    dynamicComponentName.value = data.component;
};
const closeModal = () => {
    receivedData.value.show = false;
};

</script>

<template>
    <Head>
        <title>
            Section management
        </title>
    </Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100 h-screen">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="container-fluid mx-auto">
                            <div class="flex flex-wrap justify-between">
                                <div class="w-full flex-1">
                                    <h6 class="text-blueGray-700 text-xl font-bold uppercase text-left">
                                        {{ 'Section Management' }}
                                    </h6>
                                </div>
                                <div class="w-12/12">
                                    <SectionMenu @show-modal="showModal"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-3">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <Sections :sectionItems="sectionItems" :sections="sections"/>
                        </div>
                    </div>
                    <div v-if="receivedData.show"
                         class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
                        <div class="relative w-full my-6 mx-auto max-w-3xl">
                            <dynamicComponentName @close-modal="closeModal" :sections="sections"
                                                  :subcategories="subcategories"
                                                  :places="places"
                            />
                        </div>
                    </div>
                    <div v-if="receivedData.show" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
