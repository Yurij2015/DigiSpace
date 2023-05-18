<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps(['menu']);
let pageTitle = "Public menu";

</script>

<template>
    <Head><title>{{ pageTitle }} | Admin Panel</title></Head>
    <sidebar/>
    <div class="relative md:ml-64 bg-blueGray-100">
        <AdminNavbar/>
        <HeaderStats/>
        <div class="px-4 md:px-10 mx-auto w-full -m-24">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">Menu items</h6>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                    <div class="flex flex-wrap">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <div class="block w-full overflow-x-auto">
                                <table class="items-center w-full bg-transparent border-collapse tabl table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            #
                                        </th>
                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Menu item name
                                        </th>
                                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Menu item submenu
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in menu" class="rounded border border-solid">
                                        <th class="px-6 align-middle text-xm whitespace-nowrap p-4 text-left">
                                            {{ item.id }}
                                        </th>
                                        <td class="border-t-0 px-6 align-middle rounded border border-solid text-xm whitespace-nowrap p-4">
                                            <div class="flex flex-wrap">
                                                <div class="w-full px-4 flex-1">
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                        <span class="text-lightBlue-600">Name: </span>
                                                        {{ item.name }}
                                                    </span>
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                         <span class="text-lightBlue-600">Title: </span>
                                                        {{ item.title }}
                                                    </span>
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                         <span class="text-lightBlue-600">Level: </span>
                                                        {{ item.level }}
                                                    </span>
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                         <span class="text-lightBlue-600">Position: </span>
                                                        {{ item.position ? item.position : 'null' }}
                                                    </span>
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                         <span class="text-lightBlue-600">Description: </span>
                                                        {{ item.description ? item.description : 'null' }}
                                                    </span>
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                         <span class="text-lightBlue-600">Location: </span>
                                                        {{ item.location }}
                                                    </span>
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                         <span class="text-lightBlue-600">Slug: </span>
                                                        {{ item.slug }}
                                                    </span>
                                                    <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                         <span class="text-lightBlue-600">Href: </span>
                                                        {{ item.href }}
                                                    </span>
                                                </div>
                                                <div class="w-full px-4 flex-1">
                                                    <span
                                                        class="text-sm block my-4 p-3 text-blueGray-700 rounded border border-solid border-blueGray-100">
                                                        <Link :href="route('admin.top-menu-edit-form', item.id)" :title="item.title">
                                                                <button
                                                                    class="bg-orange-500 text-white active:bg-teal-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                                    type="button" v-on:click="editing = true">
                                                                    Edit item
                                                                </button>
                                                        </Link>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div v-for="submenu in item.menu_item" class=" rounded border border-solid">
                                                <div class="flex flex-wrap">
                                                    <div class="w-full px-4 flex-1">
                                                        <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                             <span class="text-lightBlue-600">Name: </span>
                                                            {{ submenu.name }}
                                                        </span>
                                                        <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                             <span class="text-lightBlue-600">Slug: </span>
                                                            {{ submenu.slug }}
                                                        </span>
                                                        <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                             <span class="text-lightBlue-600">Href: </span>
                                                            {{ submenu.href }}
                                                        </span>
                                                    </div>
                                                    <div class="w-full px-4 flex-1">
                                                        <span class="text-sm block my-1 p-1 text-blueGray-700">
                                                                <button
                                                                    class="bg-lightBlue-500 text-white active:bg-teal-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                                    type="button">
                                                                    Edit submenu item
                                                                </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </td>
                                        <hr>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <FooterAdmin/>
        </div>
    </div>
</template>
