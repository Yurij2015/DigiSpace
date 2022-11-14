<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PostAdmin from '@/Components/Admin/PostAdmin.vue';
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";
import {Head} from '@inertiajs/inertia-vue3';

defineProps(['posts']);
</script>

<template>
    <Head><title>Posts | Admin Panel</title></Head>
    <div>
        <sidebar/>
        <AuthenticatedLayout>
            <div class="relative md:ml-64 bg-blueGray-100">
                <AdminNavbar/>
                <HeaderStats/>
                <div class="px-4 md:px-10 mx-auto w-full">
                    <div class="flex flex-wrap">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <a href="/admin/post-store">
                                <div class="btn btn-blue text-center">
                                    Create
                                </div>
                            </a>
                            <PostAdmin
                                v-for="post in posts"
                                :key="post.id"
                                :post="post"
                            />
                        </div>
                    </div>
                    <FooterAdmin/>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
