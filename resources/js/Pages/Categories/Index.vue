<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Category from '@/Components/Category.vue';
defineProps(['categories']);
</script>

<template>
    <Head title="Categories"/>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="columns-0">
                            <div style="line-height: 40px" class="font-bold">Categories</div>
                        </div>
                    </div>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                            <Category
                                v-for="category in categories"
                                :key="category.id"
                                :category="category"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
