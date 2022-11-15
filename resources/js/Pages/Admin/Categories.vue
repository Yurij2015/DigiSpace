<script setup>
import CategoryAdmin from '@/Components/Admin/CategoryAdmin.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";

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
            <div class="px-4 md:px-10 mx-auto w-full">
                <div class="flex flex-wrap">
                    <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="p-6 bg-white border-b border-gray-200">
                                Add category!
                            </div>
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
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                            <CategoryAdmin
                                v-for="category in categories"
                                :key="category.id"
                                :category="category"
                            />
                        </div>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
