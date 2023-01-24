<script setup>
const props = defineProps(['category']);
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div class="grid grid-cols-2">
                <div>
                    <p class="text-gray-800">{{ category.name }}</p>
                    <p class="text-gray-900">{{ category.description }}</p>
                </div>
                <div>
                    <div style="float:right">
                        <Link :href="route('categories.show', category.id)">
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
