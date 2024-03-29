<script setup>
defineProps(['locales'])
</script>

<template>
    <table class="w-full">
        <tbody>
        <tr v-for="(locale, key) in locales" :key="locale.id" class="hover:bg-teal-200">
            <template v-if="locale.title">
                <td class="px-4 align-middle border border-blueGray-400 text-xs whitespace-pre-wrap p-3">
                    {{ key }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-xs whitespace-pre-wrap p-3">
                    {{ locale.title }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-xs whitespace-pre-wrap p-3">
                    {{ locale.description }}
                </td>
            </template>
        </tr>
        </tbody>
    </table>
</template>
