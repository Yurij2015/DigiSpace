<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';

const form = useForm({
    title: '',
    details: '',
    price_value: '',
    product_code: '',
    product_name: '',
    description: '',
    position: '',
    is_prefered: '',
    is_active: '',
});
</script>
<template>
    <Head><title>Create product | Admin Panel</title></Head>
    <div>
        <Sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full m-10">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Create product</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.post(route('admin.product-store'), { onSuccess: () => form.reset() })">

                                    <label for="title" class="font-bold">Title</label>
                                    <input
                                        v-model="form.title"
                                        id="title"
                                        placeholder="What is service title?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.title" class="mt-2"/>

                                    <label for="details" class="font-bold">Details</label>
                                    <input
                                        v-model="form.details"
                                        id="details"
                                        placeholder="What is service details?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.details" class="mt-2"/>

                                    <label for="price_value" class="font-bold">Price</label>
                                    <input
                                        v-model="form.price_value"
                                        placeholder="What is product price?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.price_value" class="mt-2"/>

                                    <label for="product_code" class="font-bold">Product Code</label>
                                    <input
                                        v-model="form.product_code"
                                        placeholder="What is product code?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.product_code" class="mt-2"/>

                                    <label for="product_name" class="font-bold">Product Name</label>
                                    <input
                                        v-model="form.product_name"
                                        placeholder="What is product name?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.product_name" class="mt-2"/>

                                    <label for="description" class="font-bold">Description</label>
                                    <input
                                        type="text"
                                        v-model="form.description"
                                        placeholder="What is product description?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.description" class="mt-2"/>

                                    <label for="is_prefered" class="font-bold">Is Prefered</label>
                                    <input
                                        type="number"
                                        v-model="form.is_prefered"
                                        placeholder="Product is prefered?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.is_prefered" class="mt-2"/>

                                    <label for="position" class="font-bold">Position</label>
                                    <input
                                        type="number"
                                        v-model="form.position"
                                        placeholder="Product position in list?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.position" class="mt-2"/>

                                    <label for="is_active" class="font-bold">Is Active</label>
                                    <input
                                        type="number"
                                        v-model="form.is_active"
                                        placeholder="Is product active?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.is_active" class="mt-2"/>

                                    <PrimaryButton class="mt-4">Save product!</PrimaryButton>
                                    <Link :href="route('admin.products')">
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
