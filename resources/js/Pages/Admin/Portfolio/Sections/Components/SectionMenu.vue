<script setup>

import AddSection from "@/Pages/Admin/Portfolio/Sections/Components/AddSection.vue";
import AddSubcategory from "@/Pages/Admin/Portfolio/Sections/Components/AddSubcategory.vue";
import AddPlace from "@/Pages/Admin/Portfolio/Sections/Components/AddPlace.vue";
import AddSectionItem from "@/Pages/Admin/Portfolio/Sections/Components/AddSectionItem.vue";
import AddLanguage from "@/Pages/Admin/Portfolio/Sections/Components/AddLanguage.vue";
import AddLocale from "@/Pages/Admin/Portfolio/Sections/Components/AddLocale.vue";
import AddLink from "@/Pages/Admin/Portfolio/Sections/Components/AddLink.vue";

const menuItems = {
    1: {
        component: AddSection,
        name: 'Add section'
    },
    2: {
        component: AddSubcategory,
        name: 'Add subcategory'
    },
    3: {
        component: AddPlace,
        name: 'Add place'
    },
    4: {
        component: AddSectionItem,
        name: 'Add section item'
    },
    5: {
        component: AddLanguage,
        name: 'Add language'
    },
    6: {
        component: AddLocale,
        name: 'Add locale'
    },
    7: {
        component: AddLink,
        name: 'Add link'
    }
};


</script>
<template>
    <div class="flex-1">
        <button v-for="(item, index) in menuItems"
                :key="index"
                class="text-white  font-bold uppercase uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 float-right"
                :class="item.component === AddSectionItem ? 'bg-indigo-500 active:bg-indigo-600' : 'bg-pink-500 active:bg-pink-600'"
                type="button" @click="$emit('show-modal', {'component' : item.component, 'show': true})">
            {{ item.name }}
        </button>
    </div>
</template>
