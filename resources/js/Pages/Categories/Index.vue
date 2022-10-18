<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Ticket from '@/Components/Ticket.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';

defineProps(['categories']);

const form = useForm({
    message: '',
});
</script>

<template>
    <Head title="Categories"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        List of Categories55!
                    </div>
                    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                            <h3>{{ categories }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

