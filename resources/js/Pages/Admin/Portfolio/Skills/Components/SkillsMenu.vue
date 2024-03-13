<script setup>

import {Link} from "@inertiajs/inertia-vue3";
</script>

<template>
    <div class="flex-1 mx-1">
        <Link :href="route('portfolio.add-skill-type')"
              class="font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 w-full"
              type="button"
              :class="route().current('portfolio.add-skill') ? 'bg-emerald-300 active:bg-emerald-300 text-black' : 'bg-emerald-500 active:bg-emerald-600 text-white'">
            Add skill type
        </Link>
    </div>
    <div class="flex-1 mx-1">
        <Link :href="route('portfolio.add-skill-subcategory')"
              class="font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 w-full"
              type="button"
              :class="route().current('portfolio.add-skill-subcategory') ? 'bg-emerald-300 active:bg-emerald-300 text-black' : 'bg-emerald-500 active:bg-emerald-600 text-white'">
            Add skill subcategory
        </Link>
    </div>
    <div class="flex-1 mx-1">
        <Link :href="route('portfolio.add-skill')"
              class="font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 w-full"
              type="button"
              :class="route().current('portfolio.add-skill') ? 'bg-emerald-300 active:bg-emerald-300 text-black' : 'bg-emerald-500 active:bg-emerald-600 text-white'">
            Add skill
        </Link>
    </div>
    <div class="flex-1 mx-1">
        <Link :href="route('portfolio.add-skill-locale')"
              class="font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 w-full"
              type="button"
              :class="route().current('portfolio.add-skill-locale') ? 'bg-emerald-300 active:bg-emerald-300 text-black' : 'bg-emerald-500 active:bg-emerald-600 text-white'">
            Add skill locale
        </Link>
    </div>
</template>

<style scoped>

</style>
