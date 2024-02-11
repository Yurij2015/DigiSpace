<script setup>
import SkillRow from "@/Pages/Admin/Portfolio/Skills/Components/SkillRow.vue";

defineProps(['skills']);
</script>

<template>
    <table class="items-center w-full bg-transparent border-collapse border table-auto" aria-label="Skill list">
        <caption class="caption-top font-bold mb-4">
            SKILLS
        </caption>
        <thead>
        <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Id
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Skill Type
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Image icon url
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                FaIcon
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Value
            </th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-4 text-x uppercase whitespace-nowrap font-semibold text-left hover:bg-sky-200 font-bold">
                Locales
            </th>
        </tr>
        </thead>
        <tbody>
        <SkillRow v-for="skill in skills"
                  :key="skill.id"
                  :skill="skill">
        </SkillRow>
        </tbody>
    </table>
</template>
