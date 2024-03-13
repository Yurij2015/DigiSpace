<script setup>
import SkillTypesList from "@/Pages/Admin/Portfolio/Skills/Components/SkillTypesList.vue";

defineProps(['skillTypes']);
</script>

<template>
    <table class="items-center w-full bg-transparent border-collapse border" aria-label="Skill list">
        <caption class="caption-top font-bold mb-4">
            SKILL TYPES
        </caption>
        <thead>
        <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Id
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Skill type
            </th>
        </tr>
        </thead>
        <tbody>
        <SkillTypesList v-for="skillType in skillTypes"
                        :key="skillType.id"
                        :skill-type="skillType">
        </SkillTypesList>
        </tbody>
    </table>
</template>

