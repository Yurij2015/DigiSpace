<script setup>
const props = defineProps(['post']);
</script>

<template>
        <div class="p-6 flex space-x-2">
            <div class="flex-1">
                <div class="grid grid-cols-2">
                    <div >
                        <p class="text-gray-800">{{ post.name }}</p>
                        <p class="text-gray-800">{{ post.category.name }}</p>
                        <p class="text-gray-900">{{ post.content }}</p>
                    </div>
                    <div>
                        <a :href="route('admin.post-update', post.id)">
                            <div class="btn btn-blue text-center" style="float:right;">
                                Edit
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</template>
