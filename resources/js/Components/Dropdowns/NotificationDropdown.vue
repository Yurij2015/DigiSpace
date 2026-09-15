<script setup>
import {ref} from "vue";

let dropdownPopoverShow = ref(false);
let toggleDropdown = function (event) {
    event.preventDefault();
    if (dropdownPopoverShow.value) {
        dropdownPopoverShow.value = false;
    } else {
        dropdownPopoverShow.value = true;
    }
}
</script>
<template>
    <div class="relative">
        <a
            class="text-blueGray-500 block py-1 px-3"
            v-on:click="toggleDropdown($event)"
            href="#notifications"
            aria-label="Open notifications"
        >
            <i class="fas fa-bell"></i>
        </a>
        <div
            class="absolute right-0 mt-2 bg-white text-base z-50 py-2 list-none text-left rounded-lg shadow-lg min-w-48 border border-blueGray-100"
            v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
        >
            <p class="text-sm py-2 px-4 text-blueGray-500 whitespace-nowrap">No notifications</p>
        </div>
    </div>
</template>
