<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import SkillsMenu from "@/Pages/Admin/Portfolio/Skills/Components/SkillsMenu.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps(['skillTypes']);

const form = useForm({
    skill_type_id: 1,
    skill_progress: '',
    type: '',
    fa_icon: '',
    locales: {
        en: {title: ''},
        ua: {title: ''},
        pl: {title: ''}
    }
});

</script>

<template>
    <Head><title>Skill subcategories</title></Head>
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
                                <h6 class="text-blueGray-700 text-xl font-bold uppercase text-left">Skill
                                    subcategories</h6>
                            </div>
                            <SkillsMenu/>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0 mt-3">
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                            <form
                                @submit.prevent="form.post(route('portfolio.skill-subcategory-store'))">
                                <select
                                    class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                    v-model='form.skill_type_id'>
                                    <option v-for='skillType in skillTypes'
                                            :value='skillType.id'>
                                        {{ skillType.skill_type }}
                                    </option>
                                </select>
                                <input
                                    v-model="form.type"
                                    placeholder="Skill subcategory type"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <InputError :message="form.errors.type" class="mt-2"/>
                                <input
                                    v-model="form.skill_progress"
                                    placeholder="Skill subcategory progress"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <InputError :message="form.errors.skill_progress" class="mt-2"/>
                                <input
                                    v-model="form.fa_icon"
                                    placeholder="Skill subcategory font awesome icon"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <InputError :message="form.errors.fa_icon" class="mt-2"/>
                                <input
                                    v-model="form.locales.en.title"
                                    placeholder="Skill subcategory name (en)"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <input
                                    v-model="form.locales.ua.title"
                                    placeholder="Skill subcategory name (ua)"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <input
                                    v-model="form.locales.pl.title"
                                    placeholder="Skill subcategory name (pl)"
                                    class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                >
                                <PrimaryButton class="mt-4">Save skill subcategory!</PrimaryButton>
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
