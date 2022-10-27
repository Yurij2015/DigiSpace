<script setup>
const props = defineProps(['post']);
</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800">{{ post.name }}</span>
                </div>
            </div>
            <p class="text-gray-800">{{ post.category.name }}</p>
            <p class="mt-4 text-lg text-gray-900">{{ post.content }}</p>
        </div>
    </div>
</template>
