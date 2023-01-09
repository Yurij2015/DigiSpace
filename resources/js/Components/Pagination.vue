<script setup>
import {Link} from "@inertiajs/inertia-vue3";

defineProps(['links']);
</script>
<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in links" :key="key">
                <div
                    v-if="link.url === null"
                    class="bg-emerald-200 text-black font-bold uppercase text-xs px-4 py-2 rounded outline-none mr-1 ease-linear transition-all duration-150"
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="bg-emerald-400 text-white uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                    :class="{ 'active:bg-emerald-600 font-bold bg-emerald-500': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>
