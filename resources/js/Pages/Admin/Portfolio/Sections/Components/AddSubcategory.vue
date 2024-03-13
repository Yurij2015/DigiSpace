<script setup>
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

defineEmits(['close-modal']);
defineProps(['sections']);

const form = useForm({
    section_id: '',
    name: '',
    slug: '',
    type: '',
    progress: '',
    fa_icon: '',
    locales: {
        en: {title: '', description: ''},
        ua: {title: '', description: ''},
        pl: {title: '', description: ''}
    }
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
            <h3 class="text-3xl font-semibold">
                Add Subcategory
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
                @submit.prevent="form.post(route('portfolio.subcategory-store'));  submitForm($emit)">
                <div class="mb-12">
                    <div>
                        <label for="skillTypeId" class="font-bold">Subcategory section</label>
                        <select
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                            id="skillTypeId"
                            v-model='form.section_id'>
                            <option v-for='section in sections'
                                    :value='section.id'>
                                {{ section.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="name" class="font-bold">Subcategory Name</label>
                        <input
                            v-model="form.name"
                            id="name"
                            placeholder="Subcategory name"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <label for="slug" class="font-bold">Subcategory Slug</label>
                        <input
                            v-model="form.slug"
                            id="slug"
                            placeholder="Subcategory slug"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.slug"/>
                    </div>
                    <div class="mt-3">
                        <label for="type" class="font-bold">Subcategory Type</label>
                        <input
                            v-model="form.type"
                            id="type"
                            placeholder="Subcategory type"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.type"/>
                    </div>
                    <div class="mt-3">
                        <label for="progress" class="font-bold">Subcategory Progress</label>
                        <input
                            v-model="form.progress"
                            id="progress"
                            placeholder="Subcategory progress"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.progress"/>
                    </div>
                    <div class="mt-3">
                        <label for="fa_icon" class="font-bold">Subcategory FaIcon</label>
                        <input
                            v-model="form.fa_icon"
                            id="fa_icon"
                            placeholder="Section description"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.fa_icon"/>
                    </div>
                    <div class="mt-3">
                        <label for="enTitle" class="font-bold">Title (en)</label>
                        <input
                            v-model="form.locales.en.title"
                            id="enTitle"
                            placeholder="Title (en)"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                    <div class="mt-3">
                        <label for="enDescription" class="font-bold">Description (en)</label>
                        <input
                            v-model="form.locales.en.description"
                            placeholder="Description (en)"
                            id="enDescription"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                    <div class="mt-3">
                        <label for="uaTitle" class="font-bold">Title (ua)</label>
                        <input
                            v-model="form.locales.ua.title"
                            placeholder="Title (ua)"
                            id="uaTitle"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                    <div class="mt-3">
                        <label for="uaDescription" class="font-bold">Description (ua)</label>
                        <input
                            v-model="form.locales.ua.description"
                            placeholder="Description (ua)"
                            id="uaDescription"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                    <div class="mt-3">
                        <label for="plTitle" class="font-bold">Title (pl)</label>
                        <input
                            v-model="form.locales.pl.title"
                            placeholder="Title (pl)"
                            id="plTitle"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                    <div class="mt-3">
                        <label for="plDescription" class="font-bold">Description (pl)</label>
                        <input
                            v-model="form.locales.pl.description"
                            placeholder="Description (pl)"
                            id="plDescription"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                </div>
                <div
                    class="flex items-center justify-end pt-6 border-t border-solid border-blueGray-200 rounded-b">
                    <button
                        class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button" @click="$emit('close-modal')">
                        Close
                    </button>
                    <button
                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="submit">
                        Save subcategory!
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
