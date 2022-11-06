<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Post from '@/Components/Post.vue';

import {Head} from '@inertiajs/inertia-vue3';

defineProps(['posts']);
</script>

<template>
    <Head title="Posts"><title>Posts</title>
    </Head>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="columns-0">
                        <div style="line-height: 40px" class="font-bold">Posts</div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <Post
                        v-for="post in posts"
                        :key="post.id"
                        :post="post"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
