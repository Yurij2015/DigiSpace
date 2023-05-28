<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

let pageTitle = "Edit sub menu item";

const props = defineProps(['subMenuItem']);

const form = useForm({
    name: props.subMenuItem.name,
    slug: props.subMenuItem.slug,
    href: props.subMenuItem.href
});
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
                        <h6 class="text-blueGray-700 text-xl font-bold">SubMenu item edit</h6>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                    <div class="flex flex-wrap">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <div class="block w-full overflow-x-auto">
                                <form
                                    @submit.prevent="form.put(route('admin.top-sub-menu-update', subMenuItem.id))">
                                    <div class="flex flex-wrap">
                                        <div class="w-full lg:w-12/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label
                                                    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                    htmlFor="grid-password"
                                                    :for="subMenuItem.name"
                                                >
                                                    Name
                                                </label>
                                                <input
                                                    type="text"
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                    v-model="form.name"
                                                    :id="subMenuItem.name"
                                                />
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-12/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label
                                                    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                    htmlFor="grid-password"
                                                    :for="subMenuItem.slug"
                                                >
                                                    Slug
                                                </label>
                                                <input
                                                    type="text"
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                    v-model="form.slug"
                                                    :id="subMenuItem.slug"
                                                />
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-12/12 px-4">
                                            <div class="relative w-full mb-3">
                                                <label
                                                    class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                    htmlFor="grid-password"
                                                    :for="subMenuItem.href"
                                                >
                                                    Href
                                                </label>
                                                <input
                                                    type="text"
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                    :id="subMenuItem.href"
                                                    v-model="form.href"
                                                />
                                            </div>
                                        </div>
                                        <PrimaryButton class="mt-4">Save!</PrimaryButton>
                                        <Link :href="route('admin.top-menu')">
                                            <button
                                                class="mt-4 bg-orange-500 text-white active:bg-orange-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                type="button"
                                            >
                                                Back
                                            </button>
                                        </Link>
                                    </div>
                                    <hr class="mt-6 border-b-1 border-blueGray-300"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <FooterAdmin/>
        </div>
    </div>
</template>
