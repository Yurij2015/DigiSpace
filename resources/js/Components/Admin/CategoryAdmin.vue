<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {useForm} from '@inertiajs/inertia-vue3';
import {ref} from 'vue';

dayjs.extend(relativeTime);
const props = defineProps(['category']);

const form = useForm({
    name: props.category.name,
    description: props.category.description,
});

const editing = ref(false);
</script>

<template>
    <div class="p-6 flex space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
             viewBox="0 0 20 20" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17.927,5.828h-4.41l-1.929-1.961c-0.078-0.079-0.186-0.125-0.297-0.125H4.159c-0.229,0-0.417,0.188-0.417,0.417v1.669H2.073c-0.229,0-0.417,0.188-0.417,0.417v9.596c0,0.229,0.188,0.417,0.417,0.417h15.854c0.229,0,0.417-0.188,0.417-0.417V6.245C18.344,6.016,18.156,5.828,17.927,5.828 M4.577,4.577h6.539l1.231,1.251h-7.77V4.577z M17.51,15.424H2.491V6.663H17.51V15.424z"/>
        </svg>
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800">{{ category.name }}</span>
                    <small class="ml-2 text-sm text-gray-600">{{
                            new Date(category.created_at).toLocaleString()
                        }}</small>
                    <small class="ml-2 text-sm text-gray-600 text-red-400">{{
                            dayjs(category.created_at).fromNow()
                        }}</small>
                    <small v-if="category.created_at !== category.updated_at" class="text-sm text-gray-600"> &middot;
                        edited</small>
                    <small v-if="category.created_at !== category.updated_at"
                           class="ml-2 text-sm text-gray-600 text-red-400">- {{
                            dayjs(category.updated_at).fromNow()
                        }}</small>
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
                        <DropdownLink as="button" :href="route('admin.category-destroy', category.id)" method="delete">
                            Delete
                        </DropdownLink>
                        <DropdownLink as="button" :href="route('admin.category-show', category.id)">
                            View
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <form v-if="editing"
                  @submit.prevent="form.put(route('admin.category-update', category.id), { onSuccess: () => editing = false })">
                <input
                    v-model="form.name"
                    placeholder="What is category name?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                >
                <InputError :message="form.errors.name" class="mt-2"/>
                <input
                    v-model="form.description"
                    placeholder="What is category description?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                >
                <InputError :message="form.errors.description" class="mt-2"/>
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>
            <p class="mt-4 text-lg text-gray-900">{{ category.description }}</p>
        </div>
    </div>
</template>
