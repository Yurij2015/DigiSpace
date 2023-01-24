<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TicketAdmin from '@/Components/Admin/TicketAdmin.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps(['tickets']);

</script>

<template>
    <Head title="Admin Panel. Tickets" ><title>Tickets. Admin</title></Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin panel. Tickets
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        List of Tickets!
                    </div>
                    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                        <TicketAdmin
                            v-for="ticket in tickets"
                            :key="ticket.id"
                            :ticket="ticket"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
