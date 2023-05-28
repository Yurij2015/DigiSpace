<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import UsefulLink from "@/Pages/Admin/FooterUsefulLinks/Components/UsefulLink.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps(['usefulLinks']);
const form = useForm({
    name: '',
    url: '',
    status: '',
    position: ''
});

</script>

<template>
    <Head>
        <title>Userful Links | Admin Panel</title>
    </Head>
    <div>
        <Sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Useful Links in Public Footer</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                        Add link!
                                    </h6>
                                    <form
                                        @submit.prevent="form.post(route('admin.useful-link-store'), { onSuccess: () => form.reset() })">
                                        <input
                                            v-model="form.name"
                                            placeholder="What is link name?"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        >
                                        <InputError :message="form.errors.name" class="mt-2"/>
                                        <input
                                            v-model="form.url"
                                            placeholder="What is link url?"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        >
                                        <InputError :message="form.errors.url" class="mt-2"/>
                                        <input
                                            v-model="form.status"
                                            placeholder="What is link status?"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        >
                                        <InputError :message="form.errors.status" class="mt-2"/>
                                        <input
                                            v-model="form.position"
                                            placeholder="What is link position?"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        >
                                        <InputError :message="form.errors.position" class="mt-2"/>
                                        <PrimaryButton class="mt-4">Save link!</PrimaryButton>
                                    </form>
                                </div>
                                <hr class="mb-4 mt-8 border-b-1 border-blueGray-500 border-dotted"/>
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div
                                        v-for="usefulLink in usefulLinks"
                                    >
                                        <UsefulLink
                                            v-for="item in usefulLink.data"
                                            :key="item.id"
                                            :usefulLink="item"
                                        />
                                        <Pagination class="mt-6" :links="usefulLink.links"/>
                                    </div>
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
