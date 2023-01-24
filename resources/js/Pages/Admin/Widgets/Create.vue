<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/InputLabel.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';

let props = defineProps(['widgetCategories', 'api_key_tinymce']);
let widgetCategories = props.widgetCategories;
let api_key_tinymce = props.api_key_tinymce;
const form = useForm({
    title: '',
    subtitle: '',
    icon: '',
    content: '',
    widget_category_id: '',
    file: ''
});
</script>
<template>
    <Head><title>Create widget | Admin Panel</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full m-10">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Create widget</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.post(route('admin.widget-save'), { onSuccess: () => form.reset() })">
                                    <input
                                        v-model="form.title"
                                        placeholder="What is widget title?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.title" class="mt-2"/>
                                    <input
                                        v-model="form.subtitle"
                                        placeholder="What is widget subtitle?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.subtitle" class="mt-2"/>

                                    <input
                                        v-model="form.icon"
                                        placeholder="What is widget icon?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.icon" class="mt-2"/>

                                    <textarea
                                        v-model="form.content"
                                        placeholder="What is widget content?"
                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    ></textarea>
                                    <InputError :message="form.errors.content" class="mt-2"/>
                                    <select
                                        class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                        v-model='form.widget_category_id'>
                                        <option v-for='widgetCategory in widgetCategories'
                                                :value='widgetCategory.id'>
                                            {{ widgetCategory.title }}
                                        </option>
                                    </select>
                                    <InputError :message="form.errors.widget_category_id" class="mt-2"/>
                                    <div>
                                        <Label for="file" value="File"/>
                                        <input
                                            id="file"
                                            type="file"
                                            class="mt-1 block w-full"
                                            @input="form.file = $event.target.files[0]"
                                            autofocus/>
                                        <span v-if="form.errors.title">{{ form.errors.file }}</span>
                                    </div>
                                    <PrimaryButton class="mt-4">Save widget!</PrimaryButton>
                                    <Link :href="route('admin.widgets')">
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
