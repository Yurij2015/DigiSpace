<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head} from '@inertiajs/inertia-vue3';
import CardDefaultPages from "@/Components/Admin/CardDefaultPages.vue";

defineProps(['defaultPages']);
let pageTitle = "Defaul pages";
</script>

<template>
    <Head><title>Widgets | Admin Panel</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <CardDefaultPages :page_title=pageTitle :default_pages=defaultPages></CardDefaultPages>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
