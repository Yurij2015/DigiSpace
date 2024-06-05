<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head} from '@inertiajs/inertia-vue3';
import Pagination from "@/Components/Pagination.vue";
import CardServiceCategories from "./Components/CardServiceCategories.vue";

defineProps(['categories']);
let pageTitle = "Service Categories";
</script>

<template>
    <Head><title> Service Categories | Admin Panel</title></Head>
    <sidebar/>
    <div class="relative md:ml-64 bg-blueGray-100">
        <AdminNavbar/>
        <HeaderStats/>
        <div class="px-4 md:px-10 mx-auto w-full -m-10">
            <CardServiceCategories :page_title=pageTitle :categories=categories.data></CardServiceCategories>
            <Pagination class="mt-6" :links="categories.links"/>
            <FooterAdmin/>
        </div>
    </div>
</template>
