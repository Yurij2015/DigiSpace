<script setup>
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
import {Link} from '@inertiajs/inertia-vue3';

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
            <Link :href="route('tickets.index')" :active="route().current('tickets.index')"
                  class="ml-3 text-white text-sm uppercase hidden lg:inline-block font-semibold"
                  v-if="$page.props.auth.user">
                Tickets
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
            <!-- Form -->
            <form
                class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"
            >
                <div class="relative flex w-full flex-wrap items-stretch">
          <span
              class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
          >
            <i class="fas fa-search"></i>
          </span>
                    <input
                        type="text"
                        placeholder="Search here..."
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
                    />
                </div>
            </form>
            <!-- User -->
            <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                <user-dropdown/>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</template>
