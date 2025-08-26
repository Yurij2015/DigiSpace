<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';

const props = defineProps(['productServices', 'product']);

const form = useForm({
    servicesStyles: props.product.services,
});

</script>
<template>
    <Head><title>Update product | Admin Panel</title></Head>
    <div>
        <Sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full m-10">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100
                    border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Update services CSS styles</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.put(route('admin.save-product-services-style', product.id),
                                    { onSuccess: () => form.reset() })">

                                    <div v-for="(value, key) in product.services" :key="key">
                                        <label for="details" class="font-bold">{{ value.title }}</label>
                                        <input
                                            placeholder="What is product details?"
                                            v-model="form.servicesStyles[key].service_style.service_css_class"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        >
                                    </div>

                                    <PrimaryButton class="mt-4">Update service styles!</PrimaryButton>
                                    <Link :href="route('admin.products')">
                                        <button
                                            class="bg-orange-500 text-white active:bg-orange-600 font-bold uppercase
                                            text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none
                                            focus:outline-none
                                            mr-1 mb-1 ease-linear transition-all duration-150"
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
