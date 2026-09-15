<script setup>
import {computed} from 'vue';
import {usePage} from '@inertiajs/vue3';
import CardStats from "@/Components/Cards/CardStats.vue";

const page = usePage();
const stats = computed(() => page.props.adminStats || {});
const items = [
    {label: 'CATEGORIES', key: 'categories', icon: 'fas fa-chart-pie', color: 'bg-orange-500'},
    {label: 'PAGES', key: 'pages', icon: 'fas fa-file-alt', color: 'bg-blue-500'},
    {label: 'POSTS', key: 'posts', icon: 'fas fa-newspaper', color: 'bg-pink-500'},
    {label: 'SERVICES', key: 'services', icon: 'fas fa-cube', color: 'bg-emerald-500'},
];
</script>

<template>
    <div class="relative bg-emerald-600 md:pt-32 pb-28 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div class="flex flex-wrap -mx-2">
                <div v-for="item in items" :key="item.key" class="w-full lg:w-6/12 xl:w-3/12 px-2">
                    <card-stats
                        :stat-subtitle="item.label"
                        :stat-title="String(stats[item.key] ?? 0)"
                        stat-descripiron="Current records"
                        :stat-icon-name="item.icon"
                        :stat-icon-color="item.color"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
