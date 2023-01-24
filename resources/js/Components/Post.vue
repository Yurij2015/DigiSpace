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
                    <p class="text-gray-900"  v-html='post.content'/>
                    <img :src="post.img_path" width="400" />
                </div>
                <div>
                    <div style="float:right">
                        <Link :href="route('posts.show', post.id)">
                            <div class="btn btn-blue text-center">
                                View
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
