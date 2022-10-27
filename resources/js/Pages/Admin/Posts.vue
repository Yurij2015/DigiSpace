<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PostAdmin from '@/Components/Admin/PostAdmin.vue';


import {Head} from '@inertiajs/inertia-vue3';

defineProps(['posts']);
</script>

<template>
    <Head title="Admin Panel. Posts"><title>Posts. Admin</title>
    </Head>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="columns-2">
                        <div style="line-height: 40px" class="font-bold">Posts</div>
                        <div style="float: right">
                            <a href="/admin/post-store">
                                <div class="btn btn-blue text-center">
                                    Create
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <PostAdmin
                        v-for="post in posts"
                        :key="post.id"
                        :post="post"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
