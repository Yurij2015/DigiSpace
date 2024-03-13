<script setup>
import SkillLocalesTable from "@/Pages/Admin/Portfolio/Skills/Components/SkillLocalesTable.vue";

defineProps(['skill'])
</script>

<template>
    <tr class="hover:bg-sky-100">
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skill.id }}
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skill.skill_type.skill_type }}
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skill.image_icon_url }}
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skill.fa_icon }}
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skill.value }}
        </td>
        <td class="border-t-0 px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            <SkillLocalesTable :locales="skill.locales"/>
        </td>
    </tr>
</template>

<style scoped>

</style>
