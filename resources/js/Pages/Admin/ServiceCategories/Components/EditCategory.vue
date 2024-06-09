<script setup>
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

defineEmits(['close-modal']);
const props = defineProps(['category']);

const form = useForm({
    name: props.category.name,
    seo_keywords: props.category.seo_keywords,
    seo_description: props.category.seo_description,
    seo_title: props.category.seo_title
});

const submitForm = (emit) => {
    if (form.name) {
        emit('close-modal')
    }
}

</script>
<template>
    <div
        class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
        <div
            class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h3 class="text-2xl font-bold">
                Add Category
            </h3>
            <button
                class="p-1 ml-auto bg-transparent border-0 text-black float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                @click="$emit('close-modal')">
              <span class="bg-transparent text-black opacity-4 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
            </button>
        </div>
        <div class="relative p-6 flex-auto">
            <form
                @submit.prevent="form.put(route('admin.service-category-update', category.slug));  submitForm($emit)">
                <div class="mb-12">
                    <div class="mt-3">
                        <label for="name" class="font-bold">Category Name</label>
                        <input
                            v-model="form.name"
                            id="name"
                            placeholder="Category name"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <label for="seo_title" class="font-bold">SEO title</label>
                        <input
                            v-model="form.seo_title"
                            id="seo_title"
                            placeholder="SEO title"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.seo_title" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <label for="seo_description" class="font-bold">SEO description</label>
                        <input
                            v-model="form.seo_description"
                            id="seo_description"
                            placeholder="SEO description"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.seo_description" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <label for="seo_keywords" class="font-bold">SEO keywords</label>
                        <input
                            v-model="form.seo_keywords"
                            id="seo_keywords"
                            placeholder="SEO keywords"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.seo_keywords" class="mt-2"/>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end pt-6 border-t border-solid border-blueGray-200 rounded-b">
                    <button
                        class="text-red-500 background-transparent font-bold uppercase px-4 py-2 text-sm outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                        type="button" @click="$emit('close-modal')">
                        Close
                    </button>
                    <button
                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 float-right"
                        type="submit">
                        Update category!
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
