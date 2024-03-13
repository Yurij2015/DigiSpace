<script setup>
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

defineEmits(['close-modal']);
defineProps(['sections', 'subcategories', 'places']);

const form = useForm({
    section_id: 1,
    subcategory_id: '',
    name: '',
    slug: '',
    title: '',
    place_id: '',
    period: {
        start: '',
        end: ''
    },
    image_icon_url: '',
    fa_icon: '',
    value: '',
    logo_url: '',
    href: '',
    locales: {
        en: {title: '', description: '', tags: {}},
        ua: {title: '', description: '', tags: {}},
        pl: {title: '', description: '', tags: {}}
    },
    links: {
        first: {fa_icon: '', href: ''},
        second: {fa_icon: '', href: ''},
        third: {fa_icon: '', href: ''},
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
                Add Section Item
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
                @submit.prevent="form.post(route('portfolio.section-item-store'));  submitForm($emit)">
                <div class="mb-12">
                    <div>
                        <label for="section" class="font-bold">Section</label>
                        <select
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                            id="section"
                            v-model='form.section_id'>
                            <option v-for='section in sections'
                                    :value='section.id'>
                                {{ section.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="subcategory" class="font-bold">Subcategory</label>
                        <select
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                            id="subcategory"
                            v-model='form.subcategory_id'>
                            <option v-for='subcategory in subcategories'
                                    :value='subcategory.id'>
                                {{ subcategory.name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex-1 mr-2">
                            <div class="mt-3">
                                <label for="name" class="font-bold">Name</label>
                                <input
                                    v-model="form.name"
                                    id="name"
                                    placeholder="Name"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                                <InputError :message="form.errors.name" class="mt-2"/>
                            </div>
                        </div>
                        <div class="flex-1 mr-2">
                            <div class="mt-3">
                                <label for="slug" class="font-bold">Slug</label>
                                <input
                                    v-model="form.slug"
                                    id="slug"
                                    placeholder="Slug"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                                <InputError :message="form.errors.slug"/>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mt-3">
                                <label for="description" class="font-bold">Title</label>
                                <input
                                    v-model="form.title"
                                    id="description"
                                    placeholder="Title"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                                <InputError :message="form.errors.title"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="subcategory" class="font-bold">Place</label>
                        <select
                            class='px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full'
                            id="subcategory"
                            v-model='form.place_id'>
                            <option v-for='place in places'
                                    :value='place.id'>
                                {{ place.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <div class="flex flex-wrap">
                            <div class="flex-1 mr-2">
                                <label for="period_start" class="font-bold">Period Start</label>
                                <input
                                    v-model="form.period.start"
                                    id="period_start"
                                    placeholder="Period Start"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                            <div class="flex-1">
                                <label for="period_end" class="font-bold">Period End</label>
                                <input
                                    v-model="form.period.end"
                                    id="period_end"
                                    placeholder="Period End"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex-1 mr-2">
                            <div class="mt-3">
                                <label for="image_icon_url" class="font-bold">Image Icon Url</label>
                                <input
                                    v-model="form.image_icon_url"
                                    id="image_icon_url"
                                    placeholder="Image Icon Url"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                                <InputError :message="form.errors.image_icon_url"/>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mt-3">
                                <label for="fa_icon" class="font-bold">Fa Icon</label>
                                <input
                                    v-model="form.fa_icon"
                                    id="fa_icon"
                                    placeholder="Fa Icon"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                                <InputError :message="form.errors.fa_icon"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex-1 mr-2">
                            <div class="mt-3">
                                <label for="logo_url" class="font-bold">Logo Url</label>
                                <input
                                    v-model="form.logo_url"
                                    id="logo_url"
                                    placeholder="Logo Url"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                                <InputError :message="form.errors.logo_url"/>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mt-3">
                                <label for="href" class="font-bold">Href</label>
                                <input
                                    v-model="form.href"
                                    id="href"
                                    placeholder="Href"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                                <InputError :message="form.errors.href"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="enTitle" class="font-bold">Title (en)</label>
                        <input
                            v-model="form.locales.en.title"
                            id="enTitle"
                            placeholder="Title (en)"
                            class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                        >
                    </div>
                    <div class="mt-3">
                        <label for="enDescription" class="font-bold">Description (en)</label>
                        <input
                            v-model="form.locales.en.description"
                            placeholder="Description (en)"
                            id="enDescription"
                            class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                        >
                    </div>
                    <div class="mt-3">
                        <label for="uaTitle" class="font-bold">Title (ua)</label>
                        <input
                            v-model="form.locales.ua.title"
                            placeholder="Title (ua)"
                            id="uaTitle"
                            class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                        >
                    </div>
                    <div class="mt-3">
                        <label for="uaDescription" class="font-bold">Description (ua)</label>
                        <input
                            v-model="form.locales.ua.description"
                            placeholder="Description (ua)"
                            id="uaDescription"
                            class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                        >
                    </div>
                    <div class="mt-3">
                        <label for="plTitle" class="font-bold">Title (pl)</label>
                        <input
                            v-model="form.locales.pl.title"
                            placeholder="Title (pl)"
                            id="plTitle"
                            class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                        >
                    </div>
                    <div class="mt-3">
                        <label for="plDescription" class="font-bold">Description (pl)</label>
                        <input
                            v-model="form.locales.pl.description"
                            placeholder="Description (pl)"
                            id="plDescription"
                            class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                        >
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex-1 mr-2">
                            <div class="mt-3">
                                <label for="firstLinkFaIcon" class="font-bold">Fa Icon (first)</label>
                                <input
                                    v-model="form.links.first.fa_icon"
                                    placeholder="Fa icon (first)"
                                    id="firstLinkFaIcon"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mt-3">
                                <label for="firstLinkHref" class="font-bold">Href (first)</label>
                                <input
                                    v-model="form.links.first.href"
                                    placeholder="Href (first)"
                                    id="firstLinkHref"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex-1 mr-2">
                            <div class="mt-3">
                                <label for="seondLinkFaIcon" class="font-bold">Fa Icon (second)</label>
                                <input
                                    v-model="form.links.second.fa_icon"
                                    placeholder="Fa icon (second)"
                                    id="secondLinkFaIcon"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mt-3">
                                <label for="secondLinkHref" class="font-bold">Href (second)</label>
                                <input
                                    v-model="form.links.second.href"
                                    placeholder="Href (second)"
                                    id="secondLinkHref"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex-1 mr-2">
                            <div class="mt-3">
                                <label for="firstLinkFaIcon" class="font-bold">Fa Icon (third)</label>
                                <input
                                    v-model="form.links.third.fa_icon"
                                    placeholder="Fa icon (third)"
                                    id="thirdLinkFaIcon"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mt-3">
                                <label for="firstLinkHref" class="font-bold">Href (third)</label>
                                <input
                                    v-model="form.links.third.href"
                                    placeholder="Href (third)"
                                    id="thirdtLinkHref"
                                    class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
                                >
                            </div>
                        </div>
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
