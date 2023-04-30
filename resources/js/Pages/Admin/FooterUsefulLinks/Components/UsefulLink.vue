<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import {ref} from 'vue';

const props = defineProps(['usefulLink']);

const form = useForm({
    name: props.usefulLink.name,
    url: props.usefulLink.url,
    status: props.usefulLink.status,
    position: props.usefulLink.position,
});

const editing = ref(false);
</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-black">{{ usefulLink.name }}</h4>
                </div>
                <Dropdown>
                    <template #trigger>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <button
                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                            @click="editing = true">
                            Edit
                        </button>
                        <DropdownLink as="button" :href="route('admin.category-destroy', usefulLink.id)"
                                      method="delete">
                            Delete
                        </DropdownLink>
                        <DropdownLink as="button" :href="route('admin.category-show', usefulLink.id)">
                            View
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <form v-if="editing"
                  @submit.prevent="form.put(route('admin.category-update', usefulLink.id), { onSuccess: () => editing = false })">
                <input
                    v-model="form.name"
                    placeholder="What is category name?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                >
                <InputError :message="form.errors.name" class="mt-2"/>
                <input
                    v-model="form.url"
                    placeholder="What is category description?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                >
                <InputError :message="form.errors.url" class="mt-2"/>
                <input
                    v-model="form.status"
                    placeholder="What is category description?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                >
                <InputError :message="form.errors.status" class="mt-2"/>
                <input
                    v-model="form.position"
                    placeholder="What is category description?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                >
                <InputError :message="form.errors.position" class="mt-2"/>
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <p class="mt-4 text-lg text-black">{{ usefulLink.url }}</p>
            <p class="mt-4 text-lg text-black">{{ usefulLink.status }}</p>
            <p class="mt-4 text-lg text-black">{{ usefulLink.position }}</p>
        </div>
    </div>
    <hr class="mb-4 mt-8 border-b-1 border-blueGray-500 border-dotted"/>
</template>
