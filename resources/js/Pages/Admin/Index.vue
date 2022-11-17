<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";
import CardPageVisits from "@/components/Cards/CardPageVisits.vue";
import CardBarChart from "@/Components/Cards/CardBarChart.vue";
import CardLineChart from "@/Components/Cards/CardLineChart.vue";
import CardProfile from "@/Components/Cards/CardProfile.vue";
import CardSettings from "@/Components/Cards/CardSettings.vue";
import CardSocialTraffic from "@/Components/Cards/CardSocialTraffic.vue";
import CardStats from "@/Components/Cards/CardStats.vue";
import CardTable from "@/Components/Cards/CardTable.vue";

defineProps(['ordersPerMonth', 'profileImg']);

</script>

<template>
    <Head><title>Admin Panel</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div>
                    <div class="flex flex-wrap">
                        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
                            <CardLineChart :ordersPerMonth="ordersPerMonth"/>
                        </div>
                        <div class="w-full xl:w-4/12 px-4">
                            <CardBarChart :ordersPerMonth="ordersPerMonth"/>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-4">
                        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
                            <CardPageVisits/>
                        </div>
                        <div class="w-full xl:w-4/12 px-4">
                            <CardSocialTraffic/>
                        </div>
                    </div>
                    <CardTable/>
                    <CardSettings/>
                    <CardStats/>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
