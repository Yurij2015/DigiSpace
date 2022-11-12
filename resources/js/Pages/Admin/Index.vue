<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Admin Panel"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin panel
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div style="line-height: 40px" class="font-bold">You're logged in Admin Panel!
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex">
                    <div class="flex w-60 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <ul role="list" class="marker:text-sky-400 list-disc pl-5 space-y-3 text-slate-400">
                                <li><a href="admin/tickets">Tickets</a></li>
                                <li><a href="admin/categories">Categories</a></li>
                                <li><a href="admin/posts">Posts</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex basis-full w-100 bg-white shadow-sm sm:rounded-lg ml-1">
                        <div class="p-3 bg-white border-b border-gray-200">
                            With the help of the admin panel, you can manage the system!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
