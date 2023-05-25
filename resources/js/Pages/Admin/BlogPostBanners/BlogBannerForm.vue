<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Label from '@/Components/InputLabel.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';

const form = useForm({
    blog_page_type: 'blog',
    file: ''
});
</script>
<template>
    <Head><title>Add banner to blog | Admin Panel</title></Head>
    <div>
        <Sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full m-10">
                <!-- flash message start -->
                <div
                    v-if="$page.props.flash.message"
                    class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert"
                >
                    <span class="font-medium">
                        {{ $page.props.flash.message }}
                    </span>
                </div>
                <!-- flash message end -->
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Add banner to blog</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.post(route('admin.blog-banner-save'))">
                                    <select
                                        class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                        v-model='form.blog_page_type'>
                                        <option value='blog' selected="selected">blog</option>
                                        <option value='search'>search</option>
                                        <option value='archive'>archive</option>
                                        <option value='category'>category</option>
                                    </select>

                                    <div>
                                        <Label for="file" value="Banner"/>
                                        <input
                                            id="file"
                                            type="file"
                                            class="mt-1 block w-full"
                                            @input="form.file = $event.target.files[0]"
                                            autofocus/>
                                        <span v-if="form.errors.name">{{ form.errors.file }}</span>
                                    </div>
                                    <PrimaryButton class="mt-4">Save banner!</PrimaryButton>
                                    <Link :href="route('admin.posts-banners')">
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
