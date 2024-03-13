<script setup>
import SkillSubcategoriesProgressTalbe
    from "@/Pages/Admin/Portfolio/Skills/Components/SkillSubcategoriesProgressTalbe.vue";
import SkillSubcategoriesLocalesTable
    from "@/Pages/Admin/Portfolio/Skills/Components/SkillSubcategoriesLocalesTable.vue";

defineProps(['skillSubcategory']);

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return str;
}
</script>
<template>
    <tr class="hover:bg-sky-100">
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillSubcategory.id }}
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillSubcategory.skill_type.skill_type }}
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            <div v-if="isJson(skillSubcategory.progress)"
                 class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800">
                <SkillSubcategoriesProgressTalbe :progress="JSON.parse(skillSubcategory.progress)"/>
            </div>
            <div v-else class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800 json-content">
                {{ skillSubcategory.progress }}
            </div>
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillSubcategory.type }}
        </td>
        <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillSubcategory.fa_icon }}
        </td>
        <td class="border-t-0 px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            <SkillSubcategoriesLocalesTable :locales="skillSubcategory.locales"/>
        </td>
    </tr>
</template>
