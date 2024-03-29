<script setup>
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

defineEmits(['close-modal']);

const form = useForm({
    name: '',
    slug: '',
    logo_url: '',
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
                Add Place
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
                @submit.prevent="form.post(route('portfolio.place-store'));  submitForm($emit)">
                <div class="mb-12">
                    <div>
                        <label for="name" class="font-bold">Place Name</label>
                        <input
                            v-model="form.name"
                            id="name"
                            placeholder="Section name"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="mt-4">

                        <label for="slug" class="font-bold">Place Slug</label>
                        <input
                            v-model="form.slug"
                            id="slug"
                            placeholder="Place slug"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.slug"/>
                    </div>
                    <div class="mt-4">
                        <label for="logo_url" class="font-bold">Place Logo Url</label>
                        <input
                            v-model="form.logo_url"
                            id="logo_url"
                            placeholder="Place logo url"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.logo_url"/>
                    </div>
                    <div class="mt-4">
                        <label for="fa_icon" class="font-bold">Place FaIcon</label>
                        <input
                            v-model="form.fa_icon"
                            id="fa_icon"
                            placeholder="Place FaIcon"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                        <InputError :message="form.errors.fa_icon"/>
                    </div>
                    <div class="mt-4">
                        <label for="enTitle" class="font-bold">Title (en)</label>
                        <input
                            v-model="form.locales.en.title"
                            id="enTitle"
                            placeholder="Title (en)"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                    <div class="mt-4">
                        <label for="uaTitle" class="font-bold">Title (ua)</label>
                        <input
                            v-model="form.locales.ua.title"
                            placeholder="Title (ua)"
                            id="uaTitle"
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                        >
                    </div>
                    <div class="mt-4">
                        <label for="plTitle" class="font-bold">Title (pl)</label>
                        <input
                            v-model="form.locales.pl.title"
                            placeholder="Title (pl)"
                            id="plTitle"
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
                        Save place!
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
