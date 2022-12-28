<script setup>
import NotificationDropdown from "@/Components/Dropdowns/NotificationDropdown.vue";
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
import {Link} from '@inertiajs/inertia-vue3';
import {ref} from 'vue'
import SidebarNavLink from '@/Components/SidebarNavLink.vue';

let collapseShow = ref('hidden');

function toggleCollapseShow(classes) {
    collapseShow.value = classes;
}
</script>
<template>
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
    >
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
            <!-- Toggler -->
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button"
                v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')"
            >
                <i class="fas fa-bars"></i>
            </button>
            <!-- Brand -->
            <Link :href="route('admin')"
                  class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                CMS Admin
            </Link>
            <!-- User -->
            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">
                    <NotificationDropdown/>
                </li>
                <li class="inline-block relative">
                    <UserDropdown/>
                </li>
            </ul>
            <!-- Collapse -->
            <div
                class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
                v-bind:class="collapseShow"
            >
                <!-- Collapse header -->
                <div
                    class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200"
                >
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <Link :href="route('admin')"
                                  class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                                DigiSpace Admin
                            </Link>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button
                                type="button"
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                v-on:click="toggleCollapseShow('hidden')"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-6 mb-4 md:hidden">
                    <div class="mb-3 pt-0">
                        <input
                            type="text"
                            placeholder="Search"
                            class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                        />
                    </div>
                </form>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full"/>
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    Admin Layout Pages
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <SidebarNavLink :href="route('admin')" :active="route().current('admin')"
                                        icon="fas fa-tv mr-2 text-sm">
                            Admin
                        </SidebarNavLink>
                    </li>
                    <li class="items-center">
                        <SidebarNavLink :href="route('admin.posts')" :active="route().current('admin.posts')"
                                        icon="fas fa-tools mr-2 text-sm">
                            Posts
                        </SidebarNavLink>
                    </li>

                    <li class="items-center">
                        <SidebarNavLink :href="route('admin.categories')" :active="route().current('admin.categories')"
                                        icon="fas fa-table mr-2 text-sm">
                            Categories
                        </SidebarNavLink>
                    </li>
                    <li class="items-center">
                        <SidebarNavLink :href="route('admin.widgets')" :active="route().current('admin.widgets')"
                                        icon="fas fa-cog mr-2 text-sm">
                            Widgets
                        </SidebarNavLink>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full"/>
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    Auth Layout Pages
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                    <li class="items-center">
                        <SidebarNavLink :href="route('login')" :active="route().current('login')"
                                        icon="fas fa-fingerprint mr-2 text-sm">
                            Login
                        </SidebarNavLink>
                    </li>
                    <li class="items-center">
                        <SidebarNavLink :href="route('register')" :active="route().current('register')"
                                        icon="fas fa-clipboard-list mr-2 text-sm">
                            Register
                        </SidebarNavLink>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full"/>
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    No Layout Pages
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
                    <li class="items-center">
                        <SidebarNavLink :href="route('landing')" icon="fas fa-newspaper text-blueGray-300 mr-2 text-sm">
                            Landing (Site)
                        </SidebarNavLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
); }
