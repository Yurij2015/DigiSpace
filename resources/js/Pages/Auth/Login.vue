<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import Navbar from "@/components/Navbars/AuthNavbar.vue";
import FooterSmall from "@/components/Footers/FooterSmall.vue";
import {Link} from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
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
                                            Sign in
                                        </h6>
                                    </div>
                                    <hr class="mt-6 border-b-1 border-blueGray-300"/>
                                </div>
                                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                    <div class="text-blueGray-400 text-center mb-3 font-bold">
                                        <small>with credentials</small>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div class="relative w-full mb-3">
                                            <InputLabel for="email" value="Email"
                                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2"/>
                                            <TextInput id="email" type="email"
                                                       class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                       v-model="form.email" required
                                                       autocomplete="username" placeholder="Email"/>
                                            <InputError class="mt-2" :message="form.errors.email"/>
                                        </div>
                                        <div class="relative w-full mb-3">
                                            <div class="mt-4">
                                                <InputLabel for="password" value="Password"
                                                            class="block uppercase text-blueGray-600 text-xs font-bold mb-2"/>
                                                <TextInput id="password" type="password"
                                                           class="order-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                           v-model="form.password" required
                                                           autocomplete="current-password" placeholder="Password"/>
                                                <InputError class="mt-2" :message="form.errors.password"/>
                                            </div>
                                        </div>

                                        <div class="block mt-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <Checkbox name="remember" v-model:checked="form.remember"
                                                          id="customCheckLogin"
                                                          class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"/>
                                                <span
                                                    class="ml-2 text-sm font-semibold text-blueGray-600">Remember me</span>
                                            </label>
                                        </div>

                                        <div class="text-center mt-6">
                                            <button
                                                class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                                                type="submit"
                                            >
                                                Sign In
                                            </button>
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
                                    <Link :href="route('register')" class="text-blueGray-200">
                                        <small>Register</small>
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
