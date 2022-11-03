<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import Label from '@/Components/InputLabel.vue';

import {Head, useForm} from '@inertiajs/inertia-vue3';

defineProps(['categories']);

const form = useForm({
    name: '',
    content: '',
    category_id: '',
    file: ''
});

</script>

<template>
    <Head title="Admin Panel. Posts"><title>Posts. Admin</title>
    </Head>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="columns-1">
                        <div style="line-height: 40px" class="font-bold">Create post</div>
                    </div>
                    <form @submit.prevent="form.post(route('admin.post-store'), { onSuccess: () => form.reset() })">
                        <input
                            v-model="form.name"
                            placeholder="What is post name?"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                        >
                        <InputError :message="form.errors.name" class="mt-2"/>
                        <input
                            v-model="form.content"
                            placeholder="What is post content?"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                        >
                        <InputError :message="form.errors.content" class="mt-2"/>
                        <select
                            class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                            v-model='form.category_id'>
                            <option v-for='category in categories' :value='category.id'>{{ category.name }}</option>
                        </select>
                        <InputError :message="form.errors.category_id" class="mt-2"/>
                        <div>
                            <Label for="file" value="File"/>
                            <input
                                id="file"
                                type="file"
                                class="mt-1 block w-full"
                                @input="form.file = $event.target.files[0]"
                                autofocus/>
                            <span v-if="form.errors.name">{{ form.errors.file }}</span>
                        </div>
                        <PrimaryButton class="mt-4">Save post!</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
