<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {useForm} from '@inertiajs/inertia-vue3';

dayjs.extend(relativeTime);
const props = defineProps(['ticket']);
props.ticket = [];

const form = useForm({
    message: props.ticket.message,
});

</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800">{{ ticket.user.name }}</span>
                    <small class="ml-2 text-sm text-gray-600">{{ new Date(ticket.created_at).toLocaleString() }}</small>
                    <small class="ml-2 text-sm text-gray-600 text-red-400">{{
                            dayjs(ticket.created_at).fromNow()
                        }}</small>
                    <small v-if="ticket.created_at !== ticket.updated_at" class="text-sm text-gray-600"> &middot;
                        edited</small>
                    <small v-if="ticket.created_at !== ticket.updated_at"
                           class="ml-2 text-sm text-gray-600 text-red-400">- {{
                            dayjs(ticket.updated_at).fromNow()
                        }}</small>
                </div>
            </div>
            <p class="mt-4 text-lg text-gray-900">{{ ticket.message }}</p>
        </div>
    </div>
</template>
