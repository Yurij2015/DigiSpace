<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';
import Editor from '@tinymce/tinymce-vue'

let props = defineProps(['page', 'pageCategories', 'menuItems', 'api_key_tinymce']);
const form = useForm({
    name: props.page.name,
    meta: props.page.meta,
    description: props.page.description,
    content: props.page.content,
    slug: props.page.slug,
    page_category_id: props.page.page_category_id,
    menu_item_id: props.page.menu_item_id,
    api_key_tinymce: props.api_key_tinymce
});
</script>
<template>
    <Head><title>Update page | Admin Panel</title></Head>
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
                            <h6 class="text-blueGray-700 text-xl font-bold">Update page</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.put(route('admin.page-update', page.id))">
                                    <input
                                        v-model="form.name"
                                        placeholder="What is page title?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.name" class="mt-2"/>

                                    <input
                                        v-model="form.meta"
                                        placeholder="What is page meta?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.meta" class="mt-2"/>

                                    <textarea
                                        v-model="form.description"
                                        placeholder="What is page description?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    ></textarea>
                                    <InputError :message="form.errors.description" class="mt-2"/>

                                    <Editor
                                        :api-key=api_key_tinymce
                                        :init="{
                                            height: 500,
                                            plugins: [
                                           'advlist autolink lists link image charmap print preview anchor',
                                           'searchreplace visualblocks code fullscreen',
                                           'insertdatetime media table paste code help wordcount'
                                           ],
                                            toolbar:
                                           'undo redo | formatselect | bold italic backcolor | \
                                           alignleft aligncenter alignright alignjustify | \
                                           bullist numlist outdent indent | removeformat | help'
                                        }"
                                        v-model="form.content"
                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    ></Editor>
                                    <InputError :message="form.errors.content" class="mt-2"/>

                                    <input
                                        v-model="form.slug"
                                        placeholder="What is page slug?"
                                        class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                    >
                                    <InputError :message="form.errors.slug" class="mt-2"/>

                                    <select
                                        class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                        v-model='form.page_category_id'>
                                        <option v-for='pageCategory in pageCategories'
                                                :value='pageCategory.id'>
                                            {{ pageCategory.name }}
                                        </option>
                                    </select>
                                    <InputError :message="form.errors.page_category_id" class="mt-2"/>

                                    <select
                                        class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                        v-model='form.menu_item_id'>
                                        <option v-for='menuItem in menuItems'
                                                :value='menuItem.id'>
                                            {{ menuItem.name }}
                                        </option>
                                    </select>
                                    <InputError :message="form.errors.menu_item_id" class="mt-2"/>

                                    <PrimaryButton class="mt-4">Save page!</PrimaryButton>
                                    <Link :href="route('admin.pages')">
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
