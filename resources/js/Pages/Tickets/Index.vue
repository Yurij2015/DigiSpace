<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Ticket from '@/Components/Ticket.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';

defineProps(['tickets']);

const form = useForm({
    message: '',
});
</script>

<template>
    <Head title="Tickets"/>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <form @submit.prevent="form.post(route('tickets.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What is your issue?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                    <InputError :message="form.errors.message" class="mt-2"/>
                    <PrimaryButton class="mt-4">Ticket</PrimaryButton>
                </form>

                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <Ticket
                        v-for="ticket in tickets"
                        :key="ticket.id"
                        :ticket="ticket"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
