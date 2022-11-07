<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {Link} from '@inertiajs/inertia-vue3';

defineProps(['category', 'posts']);

</script>

<template>
    <Head title="Post"><title>{{category.name}}</title>
    </Head>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="columns-0">
                        <div style="line-height: 40px" class="font-bold">{{category.name}}</div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <div class="p-6 flex space-x-2">
                        <div class="flex-1">
                            <div class="grid grid-cols-1">
                                <div>
                                    <p class="text-gray-800">{{ category.name }}</p>
                                    <p class="text-gray-900">{{ category.description }}</p>
                                </div>
                            </div>
                            <div v-for="post in posts">
                                <Link :href="route('admin.post-update', post.id)" :title="`${'Edit post - ' + post.name}`">
                                    <ul role="list" class="marker:text-sky-400 list-disc pl-5 space-y-3 text-slate-400">
                                        <li>{{post.name}}</li>
                                    </ul>
                                </Link>
                                <p>{{post.content}}</p>
                                <img :src="post.img_path" :alt="`${post.name}`" width="200" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
