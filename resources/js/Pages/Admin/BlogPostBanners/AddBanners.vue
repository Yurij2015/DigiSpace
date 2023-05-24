<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head} from '@inertiajs/inertia-vue3';
import Post from "./Components/Post.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps(['posts']);
</script>
<template>
    <Head><title>Add banner to post | Admin Panel</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full m-10">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Add banner to post</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                    <div class="flex flex-wrap">
                                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                            <Post
                                                v-for="post in posts.data"
                                                :key="post.id"
                                                :post="post"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Pagination class="mt-6" :links="posts.links"/>
            </div>
            <FooterAdmin/>
        </div>
    </div>
</template>
