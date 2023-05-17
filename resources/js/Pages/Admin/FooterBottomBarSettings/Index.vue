<script setup>
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm} from '@inertiajs/inertia-vue3';
import {ref} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['footerBottomBarContent']);

const form = useForm({
    company_name: props.footerBottomBarContent.company_name,
    privacy_policy_title: props.footerBottomBarContent.privacy_policy_title,
    privacy_policy_href: props.footerBottomBarContent.privacy_policy_href,
    faq: props.footerBottomBarContent.faq,
    faq_href: props.footerBottomBarContent.faq_href,
    support: props.footerBottomBarContent.support,
    support_href: props.footerBottomBarContent.support_href
});
const editing = ref(false);
</script>

<template>
    <Head><title>Posts | Admin Panel</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Footer bottom bar settings</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex justify-between items-center">
                            <div class="pr-2">
                                <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                    Bottom bar information
                                </h6>
                            </div>
                            <Dropdown>
                                <template #trigger>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        </svg>
                                    </button>
                                </template>
                                <template #content>
                                    <button
                                        class="w-full px-4 py-2 text-left text-sm leading-5 text-white bg-teal-500 hover:bg-teal-500 focus:bg-teal-500 transition duration-150 ease-in-out"
                                        @click="editing = true">
                                        Edit
                                    </button>
                                </template>
                            </Dropdown>
                        </div>
                        <form
                            @submit.prevent="form.put(route('admin.bottom-bar-settings-update', footerBottomBarContent.id), { onSuccess: () => editing = false })">
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-12/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                            :for="footerBottomBarContent.company_name"
                                        >
                                            Company name
                                        </label>
                                        <input
                                            type="text"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            v-model="form.company_name"
                                            :id="footerBottomBarContent.company_name"
                                            :disabled="editing ? null : true"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                            :for="footerBottomBarContent.privacy_policy_title"
                                        >
                                            Privacy policy title
                                        </label>
                                        <input
                                            type="text"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            :id="footerBottomBarContent.privacy_policy_title"
                                            v-model="form.privacy_policy_title"
                                            :disabled="editing ? null : true"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                            :for="footerBottomBarContent.privacy_policy_href"
                                        >
                                            Privacy policy href
                                        </label>
                                        <input
                                            type="text"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            :id="footerBottomBarContent.privacy_policy_href"
                                            v-model="form.privacy_policy_href"
                                            :disabled="editing ? null : true"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                            :for="footerBottomBarContent.faq"
                                        >
                                            FAQ
                                        </label>
                                        <input
                                            type="text"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            :id="footerBottomBarContent.faq"
                                            v-model="form.faq"
                                            :disabled="editing ? null : true"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                            :for="footerBottomBarContent.faq_href"
                                        >
                                            FAQ HREF
                                        </label>
                                        <input
                                            type="text"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            :id="footerBottomBarContent.faq_href"
                                            v-model="form.faq_href"
                                            :disabled="editing ? null : true"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                            :for="footerBottomBarContent.support"
                                        >
                                            SUPPORT
                                        </label>
                                        <input
                                            type="text"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            :id="footerBottomBarContent.support"
                                            v-model="form.support"
                                            :disabled="editing ? null : true"
                                        />
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                            :for="footerBottomBarContent.support_href"
                                        >
                                            SUPPORT HREF
                                        </label>
                                        <input
                                            type="text"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            :id="footerBottomBarContent.support_href"
                                            v-model="form.support_href"
                                            :disabled="editing ? null : true"
                                        />
                                    </div>
                                </div>
                                <PrimaryButton class="mt-4" :hidden="editing ? null : true">Save!</PrimaryButton>
                                <button
                                    class="mt-4 bg-orange-500 text-white active:bg-orange-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button"
                                    @click="editing = false"
                                    :hidden="editing ? null : true"
                                >
                                    Cancel
                                </button>
                            </div>
                            <hr class="mt-6 border-b-1 border-blueGray-300"/>
                        </form>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
