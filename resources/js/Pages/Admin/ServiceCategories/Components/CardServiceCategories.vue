<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import {sanitizeUrl} from "@braintree/sanitize-url";
import {ref} from "vue";
import AddCategory from "@/Pages/Admin/ServiceCategories/Components/AddCategory.vue";
import EditCategory from "@/Pages/Admin/ServiceCategories/Components/EditCategory.vue";

const props = defineProps(['page_title', 'categories']);

const addCategoryModal = ref(false);
const editCategoryModal = ref(false);
const selectedCategory = ref(null);

const showAddCategoryModal = () => {
    addCategoryModal.value = true;
}

const showEditCategoryModal = (category) => {
    selectedCategory.value = category;
    editCategoryModal.value = true;
}

</script>
<template>
    <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex">
                    <h3 class="font-semibold text-base font-bold text-blueGray-700 flex-1">
                        {{ page_title }}
                    </h3>
                    <button
                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 float-right"
                        type="button"
                        @click='showAddCategoryModal'>
                        Add category
                    </button>
                </div>
            </div>
        </div>
        <div class="block w-full overflow-x-auto">
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                <tr>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        id
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Name
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        SEO title
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        SEO description
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        SEO keywords
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-4 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                        Operation
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="item in categories">
                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                        {{ item.id }}
                    </th>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.name }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.seo_title }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.seo_description }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{ item.seo_keywords }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        <button
                            class="bg-orange-500 text-white active:bg-teal-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            @click='showEditCategoryModal(item)'
                        >
                            Edit
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div v-if="addCategoryModal"
         class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-full my-6 mx-auto max-w-3xl">
            <AddCategory @close-modal="addCategoryModal = false"/>
        </div>
    </div>
    <div v-if="editCategoryModal"
         class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-full my-6 mx-auto max-w-3xl">
            <EditCategory @close-modal="editCategoryModal = false" :category="selectedCategory"/>
        </div>
    </div>
</template>
