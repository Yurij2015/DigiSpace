<script setup>
import {createPopper} from "@popperjs/core";
import {Link} from '@inertiajs/inertia-vue3';
import {ref} from "vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Categories from "@/Pages/Admin/Categories.vue";

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
        Menu
      </span>
            <Link :href="route('dashboard')"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Dashboard
            </Link>
            <Link
                :href="route('categories.index')"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Categories
            </Link>
            <Link
                :href="route('posts.index')"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Posts
            </Link>
            <div class="h-0 mx-4 my-2 border border-solid border-blueGray-100"/>
            <span
                class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400"
            >
        Auth
      </span>
            <Link :href="route('login')" v-if="!$page.props.auth.user"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Login
            </Link>
            <Link :href="route('register')" v-if="!$page.props.auth.user"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Register
            </Link>

            <DropdownLink :href="route('logout')" method="post"
                          v-if="$page.props.auth.user" as="button">
                Log Out
            </DropdownLink>

            <div class="h-0 mx-4 my-2 border border-solid border-blueGray-100"/>
            <span
                class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400"
            >
        Pages
      </span>
            <Link
                :href="route('about')"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                About
            </Link>
            <Link
                :href="route('services')"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Services
            </Link>
        </div>
    </div>
</template>
