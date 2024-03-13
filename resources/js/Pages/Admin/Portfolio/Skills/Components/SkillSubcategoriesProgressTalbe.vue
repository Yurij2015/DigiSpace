<script setup>
defineProps(['progress'])
</script>

<template>
    <table class="w-full">
        <tbody>
        <tr v-for="(description, key) in progress" :key="description"
            class="hover:bg-teal-200">
            <td class="px-4 align-middle border border-blueGray-400 text-xs whitespace-nowrap p-3">
                {{ key }}
            </td>
            <td class="px-4 align-middle border border-blueGray-400 text-xs whitespace-nowrap p-3">
                {{ description }}
            </td>
        </tr>
        </tbody>
    </table>
</template>
