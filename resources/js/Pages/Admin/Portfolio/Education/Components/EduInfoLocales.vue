<script setup>
const props = defineProps(['eduInfoLocale']);

</script>

<template>
    <table class="items-center w-full bg-transparent border-collapse">
        <tr class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
            <td class="border-t-0 px-3 align-middle border-l-0 border-r-0 text-xs  p-2 bg-green-200">
                {{ eduInfoLocale.locale }}
            </td>
        </tr>
        <tr class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs  p-4">
                {{ eduInfoLocale.title }}
            </td>
        </tr>
        <tr class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-x  p-4">
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs  p-4">
                {{ eduInfoLocale.description }}
            </td>
        </tr>
    </table>
</template>

<style scoped>

</style>
