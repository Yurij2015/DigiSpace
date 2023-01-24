<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
defineProps(['post']);

</script>

<template>
    <Head title="Post"><title>{{post.name}}</title>
    </Head>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="columns-0">
                        <div style="line-height: 40px" class="font-bold">{{post.name}}</div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <div class="p-6 flex space-x-2">
                        <div class="flex-1">
                            <div class="grid grid-cols-1">
                                <div>
                                    <p class="text-gray-800">{{ post.name }}</p>
                                    <p class="text-gray-800">{{ post.category.name }}</p>
                                    <p class="text-gray-900"  v-html='post.content'/>
                                    <img :src="post.img_path" :alt="`${post.name}`" style="max-width: 100%"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
