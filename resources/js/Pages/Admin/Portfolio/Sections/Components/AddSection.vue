<script setup>
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

defineEmits(['close-modal']);

const form = useForm({
    name: '',
    description: '',
    slug: '',
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
                Add Section
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
                @submit.prevent="form.post(route('portfolio.section-store'));  submitForm($emit)">
                <div class="mb-12">
                    <div>
                        <label for="name" class="font-bold">Section Name</label>
                        <input
                            v-model="form.name"
                            id="name"
                            placeholder="Section name"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="mt-4">
                        <label for="description" class="font-bold">Section Description</label>
                        <input
                            v-model="form.description"
                            id="description"
                            placeholder="Section description"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.description"/>
                    </div>
                    <div class="mt-4">
                        <label for="slug" class="font-bold">Section Slug</label>
                        <input
                            v-model="form.slug"
                            id="slug"
                            placeholder="Section slug"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                        <InputError :message="form.errors.slug"/>
                    </div>
                    <div class="mt-4">
                        <label for="enTitle" class="font-bold">Title (en)</label>
                        <input
                            v-model="form.locales.en.title"
                            id="enTitle"
                            placeholder="Title (en)"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                    </div>
                    <div class="mt-4">
                        <label for="enDescription" class="font-bold">Description (en)</label>
                        <input
                            v-model="form.locales.en.description"
                            placeholder="Description (en)"
                            id="enDescription"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                    </div>
                    <div class="mt-4">
                        <label for="uaTitle" class="font-bold">Title (ua)</label>
                        <input
                            v-model="form.locales.ua.title"
                            placeholder="Title (ua)"
                            id="uaTitle"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                    </div>
                    <div class="mt-4">
                        <label for="uaDescription" class="font-bold">Description (ua)</label>
                        <input
                            v-model="form.locales.ua.description"
                            placeholder="Description (ua)"
                            id="uaDescription"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                    </div>
                    <div class="mt-4">
                        <label for="plTitle" class="font-bold">Title (pl)</label>
                        <input
                            v-model="form.locales.pl.title"
                            placeholder="Title (pl)"
                            id="plTitle"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                        >
                    </div>
                    <div class="mt-4">
                        <label for="plDescription" class="font-bold">Description (pl)</label>
                        <input
                            v-model="form.locales.pl.description"
                            placeholder="Description (pl)"
                            id="plDescription"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
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
                        Save section!
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
