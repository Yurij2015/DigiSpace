<script setup>
import EduItemPlaceLocales from "@/Pages/Admin/Portfolio/Education/Components/EduItemPlaceLocales.vue";

const props = defineProps(['eduItemPlace']);
</script>
<template>
    <table class="items-center w-full bg-transparent border-collapse">
        <tr class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
                {{ eduItemPlace.logoUrl }}
            </td>
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
                {{ eduItemPlace.faIcon }}
            </td>
            <td>
                <EduItemPlaceLocales v-for="eduItemPlaceLocale in eduItemPlace.pf_education_item_place_locale"
                                     :key="eduItemPlaceLocale.id"
                                     :edu-item-place-locale="eduItemPlaceLocale">
                </EduItemPlaceLocales>
            </td>
        </tr>
    </table>

</template>
<style scoped>
</style>
