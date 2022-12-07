<script setup>
import CategoryAdmin from '@/Components/Admin/CategoryAdmin.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";

defineProps(['categories']);
const form = useForm({
    name: '',
    description: '',
});
</script>

<template>
    <Head><title>Categories | Admin Panel</title></Head>
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
                            <h6 class="text-blueGray-700 text-xl font-bold">Categories</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                        Add category!
                                    </h6>
                                    <form
                                        @submit.prevent="form.post(route('admin.category-store'), { onSuccess: () => form.reset() })">
                                        <input
                                            v-model="form.name"
                                            placeholder="What is category name?"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        >
                                        <InputError :message="form.errors.name" class="mt-2"/>
                                        <input
                                            v-model="form.description"
                                            placeholder="What is category description?"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        >
                                        <InputError :message="form.errors.description" class="mt-2"/>
                                        <PrimaryButton class="mt-4">Save category!</PrimaryButton>
                                    </form>
                                </div>
                                <hr class="mb-4 mt-8 border-b-1 border-blueGray-500 border-dotted"/>
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <CategoryAdmin
                                        v-for="category in categories"
                                        :key="category.id"
                                        :category="category"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
