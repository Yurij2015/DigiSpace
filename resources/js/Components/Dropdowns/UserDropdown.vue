<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import {computed, ref} from "vue";

let dropdownPopoverShow = ref(false);
const page = usePage();
const userInitial = computed(() => {
    const identity = page.props.auth?.user?.name || page.props.auth?.user?.email || 'U';

    return identity.charAt(0).toUpperCase();
});
const avatarColor = computed(() => {
    const palette = ['#dbeafe', '#e0e7ff', '#fce7f3', '#fef3c7', '#ede9fe', '#ffedd5'];
    const identity = page.props.auth?.user?.name || page.props.auth?.user?.email || 'U';
    const index = identity.toUpperCase().charCodeAt(0) % palette.length;

    return palette[index];
});

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
            class="text-blueGray-500 block"
            href="#yurii"
            v-on:click="toggleDropdown($event)"
            aria-label="Open user menu"
        >
            <div class="items-center flex">
                <span
                    class="w-10 h-10 text-sm text-blueGray-700 bg-white inline-flex items-center justify-center rounded-full border-[0.5px] border-blueGray-200/70 shadow-sm"
                >
                    <span :style="{backgroundColor: avatarColor}"
                          class="w-9 h-9 rounded-full text-blueGray-700 inline-flex items-center justify-center font-semibold">
                        {{ userInitial }}
                    </span>
                </span>
            </div>
        </a>
        <div
            class="absolute right-0 mt-2 bg-white text-base z-50 py-2 list-none text-left rounded-lg shadow-lg min-w-56 border border-blueGray-100 origin-top-right"
            v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
        >
            <div v-if="$page.props.auth.user" class="px-4 py-2 border-b border-blueGray-100">
                <p class="text-sm font-semibold text-blueGray-700 truncate">{{ $page.props.auth.user.name }}</p>
                <p class="text-xs text-blueGray-400 truncate">{{ $page.props.auth.user.email }}</p>
            </div>
            <a type="button" :href="route('login')"
               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
               v-if="!$page.props.auth.user">
                Log in
            </a>
            <Link :href="route('admin.profile')" v-if="$page.props.auth.user"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:bg-blueGray-50">
                Profile
            </Link>
            <Link :href="route('logout')" method="post" v-if="$page.props.auth.user" as="button"
               class="text-sm py-2 px-4 font-normal block w-full text-left whitespace-nowrap bg-transparent text-blueGray-700 hover:bg-blueGray-50"
            >
                Log Out
            </Link>
        </div>
    </div>
</template>
