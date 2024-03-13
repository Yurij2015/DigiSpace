<script setup>
const props = defineProps(['eduItemLocale']);
</script>

<template>
    <table class="items-center w-full bg-transparent border-collapse">
        <tr class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
            <td class="border-t-0 px-3 align-middle border-l-0 border-r-0 text-xs  p-2 bg-yellow-200">
                {{ eduItemLocale.locale }}
            </td>
        </tr>
        <tr class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs  p-4">
                {{ eduItemLocale.title }}
            </td>
        </tr>
        <tr class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs  p-4">
                {{ eduItemLocale.description }}
            </td>
        </tr>
    </table>
</template>

<style scoped>

</style>
