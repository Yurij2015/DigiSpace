<script setup>
import {createPopper} from "@popperjs/core";
import {Link} from '@inertiajs/inertia-vue3';
import {ref} from "vue";

let dropdownPopoverShow = ref(false);
let btnDropdownRef;
let popoverDropdownRef;

let toggleDropdown = function (event) {
    event.preventDefault();
    if (dropdownPopoverShow.value) {
        dropdownPopoverShow.value = false;
    } else {
        dropdownPopoverShow.value = true;
        createPopper(btnDropdownRef, popoverDropdownRef, {
            placement: "bottom-start",
        });
    }
}
</script>
<template>
    <div>
        <a
            class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
            href=""
            ref="btnDropdownRef"
            v-on:click="toggleDropdown($event)"
        >
            Demo Pages
        </a>
        <div
            ref="popoverDropdownRef"
            class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
            v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
        >
      <span
          class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400"
      >
        Admin Layout
      </span>
            <Link
                to="/admin/dashboard"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Dashboard
            </Link>
            <Link
                to="/admin/settings"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Settings
            </Link>
            <Link
                to="/admin/tables"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Tables
            </Link>
            <Link
                to="/admin/maps"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Maps
            </Link>
            <div class="h-0 mx-4 my-2 border border-solid border-blueGray-100"/>
            <span
                class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400"
            >
        Auth Layout
      </span>
            <Link
                to="/auth/login"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Login
            </Link>
            <Link
                to="/auth/register"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Register
            </Link>
            <div class="h-0 mx-4 my-2 border border-solid border-blueGray-100"/>
            <span
                class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400"
            >
        No Layout
      </span>
            <Link
                to="/landing"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Landing
            </Link>
            <Link
                to="/profile"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Profile
            </Link>
        </div>
    </div>
</template>
