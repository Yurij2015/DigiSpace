<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';
import CardProducts from "@/Components/Admin/CardProducts.vue";

defineProps(['products']);
let pageTitle = "Products";
</script>

<template>
    <Head><title>Products | Admin Panel</title></Head>
    <sidebar/>
    <div class="relative md:ml-64 bg-blueGray-100">
        <AdminNavbar/>
        <HeaderStats/>
        <div class="px-4 md:px-10 mx-auto w-full -m-10">
            <CardProducts :page_title=pageTitle :products=products></CardProducts>
            <FooterAdmin/>
        </div>
    </div>
</template>
