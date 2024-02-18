<script setup>
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

defineEmits(['close-modal']);

const form = useForm({
    name: '',
    description: '',
    slug: '',
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
                Add Language
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
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-3"
                        >
                        <InputError :message="form.errors.name" class="mt-2"/>
                    </div>
                    <div class="mt-4">
                        <label for="description" class="font-bold">Section Description</label>
                        <input
                            v-model="form.description"
                            id="description"
                            placeholder="Section description"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-3 mt-2"
                        >
                        <InputError :message="form.errors.description"/>
                    </div>
                    <div class="mt-4">

                        <label for="slug" class="font-bold">Section Slug</label>
                        <input
                            v-model="form.slug"
                            id="slug"
                            placeholder="Section slug"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-3"
                        >
                        <InputError :message="form.errors.slug"/>
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
