<script setup>
defineProps(['skillType']);
</script>
<template>
    <tr class="hover:bg-sky-100">
        <td class="border-t-0 px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillType.id }}
        </td>
        <td class="border-t-0 px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4">
            {{ skillType.skill_type }}
        </td>
    </tr>
</template>
