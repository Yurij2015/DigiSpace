<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';
import CardServices from "@/Components/Admin/CardServices.vue";

defineProps(['services']);
let pageTitle = "Services";
</script>

<template>
    <Head><title> Services | Admin Panel</title></Head>
    <sidebar/>
    <div class="relative md:ml-64 bg-blueGray-100">
        <AdminNavbar/>
        <HeaderStats/>
        <div class="px-4 md:px-10 mx-auto w-full -m-10">
            <CardServices :page_title=pageTitle :services=services></CardServices>
            <FooterAdmin/>
        </div>
    </div>
</template>
