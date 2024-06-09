<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import {Head, useForm, Link} from '@inertiajs/inertia-vue3';
import Label from "@/Components/InputLabel.vue";
import Editor from '@tinymce/tinymce-vue'

const props = defineProps(['service', 'serviceCategories', 'api_key_tinymce']);

const form = useForm({
    title: props.service.title,
    details: props.service.details,
    price: props.service.price,
    service_category_id: props.service.service_category_id,
    seo_keywords: props.service.seo_keywords,
    seo_description: props.service.seo_description,
    seo_title: props.service.seo_title,
    image_alt: props.service.image_alt,
    image: props.service.image,
    description: props.service.description,
    slug: props.service.slug,
    status: props.service.status,
    file: null
});

let api_key_tinymce = props.api_key_tinymce;

const statuses = ['active', 'inactive', 'pending', 'suspended'];

</script>
<template>
    <Head><title>Update service | Admin Panel</title></Head>
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
                            <h6 class="text-blueGray-700 text-xl font-bold">Update service</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <form
                                    @submit.prevent="form.put(route('admin.service-update', service.id))">
                                    <div class="mt-3">
                                        <label for="title" class="text-sm font-bold">Title of service:</label>
                                        <input
                                            v-model="form.title"
                                            placeholder="What is service title?"
                                            id="title"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        >
                                        <InputError :message="form.errors.title" class="mt-2"/>
                                    </div>
                                    <div class="mt-3">
                                        <label for="details" class="text-sm font-bold">Service details:</label>
                                        <textarea
                                            v-model="form.details"
                                            id="details"
                                            placeholder="What is service details?"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        />
                                        <InputError :message="form.errors.details" class="mt-2"/>
                                    </div>
                                    <div class="mt-3">
                                        <label for="price" class="text-sm font-bold">Price:</label>
                                        <input
                                            v-model="form.price"
                                            id="price"
                                            placeholder="What is service price?"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        >
                                        <InputError :message="form.errors.price" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="service_category_id" class="text-sm font-bold">Category:</label>
                                        <select
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                            v-model='form.service_category_id'>
                                            <option v-for='category in serviceCategories'
                                                    :value='category.id'>
                                                {{ category.name }}
                                            </option>
                                        </select>
                                        <InputError :message="form.errors.service_category_id" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="seo_keywords" class="text-sm font-bold">Keywords:</label>
                                        <input
                                            v-model="form.seo_keywords"
                                            id="seo_keywords"
                                            placeholder="What is service keywords?"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        >
                                        <InputError :message="form.errors.seo_keywords" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="seo_description" class="text-sm font-bold">SEO Description:</label>
                                        <textarea
                                            v-model="form.seo_description"
                                            id="seo_description"
                                            rows="3"
                                            placeholder="What is service SEO description?"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        />
                                        <InputError :message="form.errors.seo_description" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="seo_title" class="text-sm font-bold">SEO Title:</label>
                                        <input
                                            v-model="form.seo_title"
                                            id="seo_title"
                                            placeholder="What is service title?"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        >
                                        <InputError :message="form.errors.seo_title" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="description" class="text-sm font-bold">Description:</label>
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
                                            v-model="form.description"
                                            placeholder="What is service description?"
                                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                        />
                                        <InputError :message="form.errors.description" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="slug" class="text-sm font-bold">Slug:</label>
                                        <input
                                            v-model="form.slug"
                                            id="slug"
                                            placeholder="What is service slug?"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        >
                                        <InputError :message="form.errors.slug" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="status" class="text-sm font-bold">Status:</label>
                                        <select
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                            v-model='form.status'
                                            id="status"
                                        >
                                            <option v-for="status in statuses" :value="status">{{ status }}</option>
                                        </select>
                                        <InputError :message="form.errors.category_id" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <label for="image_alt" class="text-sm font-bold">Image alt:</label>
                                        <input
                                            v-model="form.image_alt"
                                            id="image_alt"
                                            placeholder="What is service image alt?"
                                            class="mb-3 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-3 py-1 text-sm border border-blueGray-300"
                                        >
                                        <InputError :message="form.errors.image_alt" class="mt-2"/>
                                    </div>

                                    <div class="mt-3">
                                        <div class="columns-1 mt-3" v-if="service.image">
                                            <img :src="service.image" width="400" :alt="service.title"/>
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
                                    </div>

                                    <PrimaryButton class="mt-4">Update service!</PrimaryButton>
                                    <Link :href="route('admin.services')">
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
