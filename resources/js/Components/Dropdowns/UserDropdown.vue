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
            class="text-blueGray-500 block"
            href="#yurii"
            ref="btnDropdownRef"
            v-on:click="toggleDropdown($event)"
        >
            <div class="items-center flex">
        <span
            class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
        >
          <img
              alt="..."
              class="w-full rounded-full align-middle border-none shadow-lg"
              :src="'/img/ava.jpg'"
          />
        </span>
            </div>
        </a>
        <div
            ref="popoverDropdownRef"
            class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
            v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
        >
            <a type="button" :href="route('login')"
               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
               v-if="!$page.props.auth.user">
                Log in
            </a>
            <Link :href="route('logout')" method="post" v-if="$page.props.auth.user" as="button"
               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
            >
                Log Out
            </Link>
            <a
                href="javascript:void(0);"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Action
            </a>
            <a
                href="javascript:void(0);"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Another action
            </a>
            <a
                href="javascript:void(0);"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Something else here
            </a>
            <div class="h-0 my-2 border border-solid border-blueGray-100"/>
            <a
                href="javascript:void(0);"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Seprated link
            </a>
        </div>
    </div>
</template>
