<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3';
import Navbar from "@/components/Navbars/AuthNavbar.vue";
import FooterSmall from "@/components/Footers/FooterSmall.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <div>
        <Navbar/>
        <main>
            <section class="relative w-full h-full py-40 min-h-screen">
                <div
                    class="absolute top-0 w-full h-full bg-blueGray-800 bg-no-repeat bg-full"
                ></div>
                <div class="container mx-auto px-4 h-full">
                    <div class="flex content-center items-center justify-center h-full">
                        <div class="w-full lg:w-4/12 px-4">
                            <div
                                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0"
                            >
                                <div class="rounded-t mb-0 px-6 py-6">
                                    <div class="text-center mb-3">
                                        <h6 class="text-blueGray-500 text-sm font-bold">
                                            Register
                                        </h6>
                                    </div>
                                    <hr class="mt-6 border-b-1 border-blueGray-300"/>
                                </div>
                                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                    <form @submit.prevent="submit">
                                        <div class="relative w-full mb-3">
                                            <InputLabel for="name" value="Name"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"/>
                                            <TextInput id="name" type="text"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       v-model="form.name" required autocomplete="name"/>
                                            <InputError class="mt-2" :message="form.errors.name"/>
                                        </div>

                                        <div class="relative w-full mb-3">
                                            <InputLabel for="email" value="Email"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"/>
                                            <TextInput id="email" type="email"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       v-model="form.email" required autocomplete="username"/>
                                            <InputError class="mt-2" :message="form.errors.email"/>
                                        </div>

                                        <div class="relative w-full mb-3">
                                            <InputLabel for="password" value="Password"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"/>
                                            <TextInput id="password" type="password"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       v-model="form.password" required autocomplete="new-password"/>
                                            <InputError class="mt-2" :message="form.errors.password"/>
                                        </div>

                                        <div class="relative w-full mb-3">
                                            <InputLabel for="password_confirmation" value="Confirm Password"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"/>
                                            <TextInput id="password_confirmation" type="password"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       v-model="form.password_confirmation"
                                                       required autocomplete="new-password"/>
                                            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <button
                                                class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                                                type="submit"
                                            >
                                                Register
                                            </button>
                                        </div>
                                        <div class="flex items-center justify-center mt-4">
                                            <Link :href="route('login')"
                                                  class="underline text-sm text-gray-600 hover:text-gray-900">
                                                Already registered?
                                            </Link>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="flex flex-wrap mt-6 relative">
                                <div class="w-1/2">
                                    <Link :href="route('dashboard')" class="text-blueGray-200">
                                        <small>Site</small>
                                    </Link>
                                </div>
                                <div class="w-1/2 text-right">
                                    <Link :href="route('login')" class="text-blueGray-200">
                                        <small>Sign in</small>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <FooterSmall absolute/>
            </section>
        </main>
    </div>
</template>
