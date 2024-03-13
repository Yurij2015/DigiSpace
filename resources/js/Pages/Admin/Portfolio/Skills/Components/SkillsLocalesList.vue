<script setup>
defineProps(['skillLocale']);
</script>
<template>
    <tr class="hover:bg-sky-100">
        <td class="border-t-0 px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillLocale.lang }}
        </td>
        <td class="border-t-0 px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4" v-html="skillLocale.title" />
        <td class="border-t-0 px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillLocale.description }}
        </td>
    </tr>
</template>
