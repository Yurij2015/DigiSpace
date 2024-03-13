<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import SkillsMenu from "@/Pages/Admin/Portfolio/Skills/Components/SkillsMenu.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    lang: 'en',
    title: '',
    description: '',
});

</script>

<template>
    <Head><title>Skills block description (diff languages)</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100 h-screen">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <div class="flex-1">
                                <h6 class="text-blueGray-700 text-xl font-bold uppercase text-left">Skills block</h6>
                            </div>
                            <SkillsMenu/>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-3">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <form
                                @submit.prevent="form.post(route('portfolio.skill-locale-store'))">
                                <select
                                    class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                    v-model='form.lang'>
                                    <option value='en'>en</option>
                                    <option value='ua'>ua</option>
                                    <option value='pl'>pl</option>
                                </select>
                                <InputError :message="form.errors.lang" class="mt-2"/>
                                <input
                                    v-model="form.title"
                                    placeholder="Skill type name"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <InputError :message="form.errors.title" class="mt-2"/>
                                <input
                                    v-model="form.description"
                                    placeholder="Skill type description"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <InputError :message="form.errors.description" class="mt-2"/>
                                <PrimaryButton class="mt-4">Save skill locale!</PrimaryButton>
                                <Link :href="route('portfolio.skills')">
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
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
