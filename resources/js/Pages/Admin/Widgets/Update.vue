<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/InputLabel.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';
import Editor from '@tinymce/tinymce-vue'

const props = defineProps(['widgetCategories', 'widget']);

const form = useForm({
    title: props.widget.title,
    content: props.widget.content,
    subtitle: props.widget.subtitle,
    icon: props.widget.icon,
    widget_category_id: props.widget.widget_category_id,
    file: null
});

</script>

<template>
    <Head><title>Edit widget | Admin Panel</title></Head>
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
                            <h6 class="text-blueGray-700 text-xl font-bold">Edit widget</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.put(route('admin.widget-update', widget.id), { onSuccess: () => form.reset() })">
                                    <input
                                        v-model="form.title"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.title" class="mt-2"/>
                                    <input
                                        v-model="form.subtitle"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.subtitle" class="mt-2"/>
                                    <input
                                        v-model="form.icon"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.icon" class="mt-2"/>
                                    <Editor
                                        api-key="7pxxebfatsrkizfz23o8eh0fz5wpqja4k03eq2z1hzpyqy5h"
                                        v-model="form.content"
                                        plugins="code"
                                        toolbar = "code"
                                        placeholder="What is post content?"
                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    />
                                    <InputError :message="form.errors.content" class="mt-2"/>
                                    <select
                                        class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                        v-model='form.widget_category_id'>
                                        <option v-for='widgetCategory in widgetCategories' :value='widgetCategory.id'>{{
                                                widgetCategory.title
                                            }}
                                        </option>
                                    </select>
                                    <InputError :message="form.errors.widget_category_id" class="mt-2"/>
                                    <div class="columns-1 mt-3">
                                        <img :src="widget.widget_image" width="400"/>
                                    </div>
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
                                    <PrimaryButton class="mt-4">Save edited widget!</PrimaryButton>
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
