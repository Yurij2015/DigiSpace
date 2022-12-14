<script setup>
import PagesDropdown from "@/Components/Dropdowns/PagesDropdown.vue";
import {Link} from '@inertiajs/inertia-vue3';

const navbarOpen = false;

const setNavbarOpen = function () {
    this.navbarOpen = !this.navbarOpen;
}

</script>
<template>
    <nav
        class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg"
    >
        <div
            class="container px-4 mx-auto flex flex-wrap items-center justify-between"
        >
            <div
                class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
            >
                <Link
                    class="text-white text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase"
                    to="/"
                >
                    DigiSpace CMS
                </Link>
                <button
                    class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                    type="button"
                    v-on:click="setNavbarOpen"
                >
                    <i class="text-white fas fa-bars"></i>
                </button>
            </div>
            <div
                class="lg:flex flex-grow items-center bg-white lg:bg-opacity-0 lg:shadow-none"
                :class="[navbarOpen ? 'block rounded shadow-lg' : 'hidden']"
                id="example-navbar-warning"
            >
                <ul class="flex flex-col lg:flex-row list-none mr-auto">
                    <li class="flex items-center">
                        <Link :href="route('dashboard')"
                            class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                        >
                            <i
                                class="lg:text-blueGray-200 text-blueGray-400 fas fa-folder text-lg leading-lg mr-2"
                            />
                            Dashboard
                        </Link>
                    </li>
                </ul>
                <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                    <li class="flex items-center">
                        <PagesDropdown/>
                    </li>
                    <li class="flex items-center">
                        <Link
                            class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                            to="/"
                            target="_blank"
                        >
                            <i
                                class="lg:text-blueGray-200 text-blueGray-400 fab fa-facebook text-lg leading-lg"
                            />
                            <span class="lg:hidden inline-block ml-2">Share</span>
                        </Link>
                    </li>

                    <li class="flex items-center">
                        <Link
                            class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                            to="/"
                            target="_blank"
                        >
                            <i
                                class="lg:text-blueGray-200 text-blueGray-400 fab fa-twitter text-lg leading-lg"
                            />
                            <span class="lg:hidden inline-block ml-2">Tweet</span>
                        </Link>
                    </li>

                    <li class="flex items-center">
                        <Link
                            class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                            to="/"
                            target="_blank"
                        >
                            <i
                                class="lg:text-blueGray-200 text-blueGray-400 fab fa-github text-lg leading-lg"
                            />
                            <span class="lg:hidden inline-block ml-2">Star</span>
                        </Link>
                    </li>

                    <li class="flex items-center">
                        <button
                            class="bg-white text-blueGray-700 active:bg-blueGray-50 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                            type="button"
                        >
                            <i class="fas fa-arrow-alt-circle-down"></i> Download
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
