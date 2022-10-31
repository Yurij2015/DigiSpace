<script setup>
const props = defineProps(['post']);
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="grid grid-cols-2">
                <div>
                    <p class="text-gray-800">{{ post.name }}</p>
                    <p class="text-gray-800">{{ post.category.name }}</p>
                    <p class="text-gray-900">{{ post.content }}</p>
                </div>
                <div>
                    <div style="float:right">
                        <a :href="route('admin.post-update', post.id)">
                            <div class="btn btn-blue text-center">
                                Edit
                            </div>
                        </a>
                        <Link :href="route('admin.post-destroy', post.id)" method="delete">
                            <div class="btn btn-brown text-center mt-1">
                                Delete
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
