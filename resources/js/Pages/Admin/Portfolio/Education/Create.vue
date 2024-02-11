<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';

const form = useForm({
    itemName: '',
    itemLocaleEnName: '',
    itemLocaleEnDescription: '',
    itemLocaleUaName: '',
    itemLocaleUaDescription: '',
    itemLocalePlName: '',
    itemLocalePlDescription: '',
    itemPeriod: '',
    placeLogoUrl: '',
    placeFaIcon: '',
    itemPlaceLocaleEnName: '',
    itemPlaceLocaleEnDescription: '',
    itemPlaceLocaleUaName: '',
    itemPlaceLocaleUaDescription: '',
    itemPlaceLocalePlName: '',
    itemPlaceLocalePlDescription: ''
});
</script>
<template>
    <Head><title>Edit education item | Admin Panel</title></Head>
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
                            <h6 class="text-blueGray-700 text-xl font-bold">Edit education item</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.post(route('portfolio.education-item-store'), { onSuccess: () => form.reset() })">
                                    <input
                                        v-model="form.itemName"
                                        placeholder="Education item name"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemName" class="mt-2"/>
                                    <input
                                        v-model="form.itemLocaleEnName"
                                        placeholder="Education item locale name (en)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemLocaleEnName" class="mt-2"/>
                                    <input
                                        v-model="form.itemLocaleEnDescription"
                                        placeholder="Education item locale desctiption (en)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemLocaleEnDescription" class="mt-2"/>
                                    <input
                                        v-model="form.itemLocaleUaName"
                                        placeholder="Education item locale name (ua)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemLocaleUaName" class="mt-2"/>
                                    <input
                                        v-model="form.itemLocaleUaDescription"
                                        placeholder="Education item locale description (ua)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemLocaleUaDescription" class="mt-2"/>
                                    <input
                                        v-model="form.itemLocalePlName"
                                        placeholder="Education item locale name (pl)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemLocalePlName" class="mt-2"/>
                                    <input
                                        v-model="form.itemLocalePlDescription"
                                        placeholder="Education item locale description (pl)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemLocalePlDescription" class="mt-2"/>
                                    <input
                                        v-model="form.itemPeriod"
                                        placeholder="Education period"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemPeriod" class="mt-2"/>
                                    <input
                                        v-model="form.placeLogoUrl"
                                        placeholder="Place logo"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.placeLogoUrl" class="mt-2"/>
                                    <input
                                        v-model="form.placeFaIcon"
                                        placeholder="Place icon"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.placeFaIcon" class="mt-2"/>
                                    <input
                                        v-model="form.itemPlaceLocaleEnName"
                                        placeholder="Item place locale name (en)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemPlaceLocaleEnName" class="mt-2"/>
                                    <input
                                        v-model="form.itemPlaceLocaleEnDescription"
                                        placeholder="Item place locale desctiption (en)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemPlaceLocaleEnDescription" class="mt-2"/>
                                    <input
                                        v-model="form.itemPlaceLocaleUaName"
                                        placeholder="Item place locale name (ua)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemPlaceLocaleUaName" class="mt-2"/>
                                    <input
                                        v-model="form.itemPlaceLocaleUaDescription"
                                        placeholder="Item place locale description (ua)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemPlaceLocaleUaDescription" class="mt-2"/>
                                    <input
                                        v-model="form.itemPlaceLocalePlName"
                                        placeholder="Item place locale name (pl)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemPlaceLocalePlName" class="mt-2"/>
                                    <input
                                        v-model="form.itemPlaceLocalePlDescription"
                                        placeholder="Item place locale description (pl)"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.itemPlaceLocalePlDescription" class="mt-2"/>
                                    <PrimaryButton class="mt-4">Save education item!</PrimaryButton>
                                    <Link :href="route('portfolio.education')">
                                        <button
                                            class="bg-orange-500 text-white active:bg-orange-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="button">
                                            Back
                                        </button>
                                    </Link>
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
