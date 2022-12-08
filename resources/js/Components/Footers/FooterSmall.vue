<script setup>
import {Link} from '@inertiajs/inertia-vue3';

const date = new Date().getFullYear();
const absolute = {
    type: Boolean,
    default: false,
}
</script>
<template>
    <footer class="pb-6" :class="[absolute ? 'absolute w-full bottom-0 bg-blueGray-800' : 'relative']">
        <div class="container mx-auto px-4">
            <hr class="mb-6 border-b-1 border-blueGray-600"/>
            <div
                class="flex flex-wrap items-center md:justify-between justify-center"
            >
                <div class="w-full md:w-4/12 px-4">
                    <div class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left">
                        Copyright © {{ date }}
                        <Link
                            to="/"
                            class="text-white hover:text-blueGray-300 text-sm font-semibold py-1"
                        >
                            DigiSpace CMS
                        </Link>
                    </div>
                </div>
                <div class="w-full md:w-8/12 px-4">
                    <ul class="flex flex-wrap list-none md:justify-end justify-center">
                        <li>
                            <Link
                                to="/"
                                class="text-white hover:text-blueGray-300 text-sm font-semibold block py-1 px-3"
                            >
                                DigiSpace CMS
                            </Link>
                        </li>
                        <li>
                            <Link
                                to="/"
                                class="text-white hover:text-blueGray-300 text-sm font-semibold block py-1 px-3"
                            >
                                About Us
                            </Link>
                        </li>
                        <li>
                            <Link
                                to="/"
                                class="text-white hover:text-blueGray-300 text-sm font-semibold block py-1 px-3"
                            >
                                Blog
                            </Link>
                        </li>
                        <li>
                            <Link to="/"
                                  class="text-white hover:text-blueGray-300 text-sm font-semibold block py-1 px-3">
                                MIT License
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
