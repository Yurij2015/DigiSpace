<script setup>
import SkillsLocalesList from "@/Pages/Admin/Portfolio/Skills/Components/SkillsLocalesList.vue";

defineProps(['skillLocales']);
</script>

<template>
    <table class="items-center w-full bg-transparent border-collapse border" aria-label="Skill list">
        <caption class="caption-top font-bold mb-4">
            SKILLS LOCALES
        </caption>
        <thead>
        <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Language
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Title
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Description
            </th>
        </tr>
        </thead>
        <tbody>
        <SkillsLocalesList v-for="skillLocale in skillLocales"
                    :key="skillLocale.id"
                    :skill-locale="skillLocale">
        </SkillsLocalesList>
        </tbody>
    </table>
</template>

