<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";
import CardPageVisits from "@/components/Cards/CardPageVisits.vue";
import CardBarChart from "@/Components/Cards/CardBarChart.vue";
import CardLineChart from "@/Components/Cards/CardLineChart.vue";

defineProps(['ordersPerMonth']);

</script>

<template>
    <Head><title>Admin Panel</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full">
                <div class="flex flex-wrap">
                    <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                        <CardPageVisits/>
                        <CardBarChart :ordersPerMonth="ordersPerMonth"/>
                        <CardLineChart :ordersPerMonth="ordersPerMonth"/>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
