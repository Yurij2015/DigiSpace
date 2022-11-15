<script setup>
const date = new Date().getFullYear();
</script>
<template>
    <footer class="block py-4">
        <div class="container mx-auto px-4">
            <hr class="mb-4 border-b-1 border-blueGray-200"/>
            <div
                class="flex flex-wrap items-center md:justify-between justify-center"
            >
                <div class="w-full md:w-4/12 px-4">
                    <div
                        class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left"
                    >
                        Copyright © {{ date }}
                        <a
                            href="/"
                            class="text-blueGray-500 hover:text-blueGray-700 text-sm font-semibold py-1"
                        >
                            DigiSpaceCMS
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-8/12 px-4">
                    <ul class="flex flex-wrap list-none md:justify-end justify-center">
                        <li>
                            <a
                                href="/"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                            >
                                DigiSpaceCMS
                            </a>
                        </li>
                        <li>
                            <a
                                href="/"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                            >
                                About Us
                            </a>
                        </li>
                        <li>
                            <a
                                href="/"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                            >
                                Blog
                            </a>
                        </li>
                        <li>
                            <a
                                href="/"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3"
                            >
                                MIT License
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
