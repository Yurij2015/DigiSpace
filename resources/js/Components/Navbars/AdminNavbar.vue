<script setup>
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
import LanguageSwitcher from "@/Components/LanguageSwitcher.vue";
import {Link} from '@inertiajs/vue3';

</script>
<template>
    <!-- Navbar -->
    <nav
        class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4"
    >
        <div
            class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
        >
            <!-- Menu -->
            <Link :href="route('dashboard')" :active="route().current('dashboard')"
                  class="text-white text-sm uppercase hidden lg:inline-block font-semibold">
                Site
            </Link>
            <Link :href="route('admin')" :active="route().current('admin')"
                  class="ml-3 text-white text-sm uppercase hidden lg:inline-block font-semibold"
                  v-if="$page.props.auth.user">
                Admin
            </Link>
            <Link :href="route('admin.categories')"
                  :active="route().current('admin.categories')"
                  class="ml-3 text-white text-sm uppercase hidden lg:inline-block font-semibold">
                Categories
            </Link>
            <Link :href="route('admin.posts')"
                  :active="route().current('admin.posts')"
                  class="ml-3 text-white text-sm uppercase hidden lg:inline-block font-semibold">
                Posts
            </Link>
            <Link :href="route('admin.widgets')"
                  :active="route().current('admin.widgets')"
                  class="ml-3 text-white text-sm uppercase hidden lg:inline-block font-semibold">
                Widgets
            </Link>
            <Link :href="route('admin.dafault-pages')"
                  :active="route().current('admin.dafault-pages')"
                  class="ml-3 text-white text-sm uppercase hidden lg:inline-block font-semibold">
                Default pages
            </Link>
            <Link :href="route('admin.pages')"
                  :active="route().current('admin.pages')"
                  class="ml-3 text-white text-sm uppercase hidden lg:inline-block font-semibold">
                Pages
            </Link>

            <div class="flex-1" aria-hidden="true"></div>
            <!-- Language -->
            <LanguageSwitcher contrast class="mr-3" />

            <!-- User -->
            <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                <user-dropdown/>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</template>
