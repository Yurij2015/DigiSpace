<script setup>
import {useForm, Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";
import Dropdown from "@/Components/Dropdown.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";

const props = defineProps(['headerNavBarContent']);

const form = useForm({
    first_col_name: props.headerNavBarContent.first_col_name,
    first_col_href: props.headerNavBarContent.first_col_href,
    first_col_href_content: props.headerNavBarContent.first_col_href_content,
    second_col_name: props.headerNavBarContent.second_col_name,
    second_col_href: props.headerNavBarContent.second_col_href,
    second_col_href_content: props.headerNavBarContent.second_col_href_content,
    first_soc_button_style: props.headerNavBarContent.first_soc_button_style,
    first_soc_button_href: props.headerNavBarContent.first_soc_button_href,
    second_soc_button_style: props.headerNavBarContent.second_soc_button_style,
    second_soc_button_href: props.headerNavBarContent.second_soc_button_href,
    third_soc_button_style: props.headerNavBarContent.third_soc_button_style,
    third_soc_button_href: props.headerNavBarContent.third_soc_button_href,
    fourth_soc_button_style: props.headerNavBarContent.fourth_soc_button_style,
    fourth_soc_button_href: props.headerNavBarContent.fourth_soc_button_href,
    login_button_status: props.headerNavBarContent.login_button_status,

});

const editing = ref(false);

</script>

<template>
    <Head>
        <title>Header Top Bar Settings | Admin Panel</title>
    </Head>
    <div>
        <Sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">Header Top Bar Settings</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex flex-wrap">
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <hr class="mb-4 mt-8 border-b-1 border-blueGray-500 border-dotted"/>
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="p-6 flex space-x-2">
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center">
                                                <div class="flex">
                                                    <div class="pr-2">
                                                        <p class="mt-4 text-lg text-black">First col name - </p>
                                                    </div>
                                                    <div>
                                                        <p class="mt-4 text-lg text-red-500">
                                                            {{ headerNavBarContent.first_col_name }}</p>
                                                    </div>
                                                </div>
                                                <Dropdown>
                                                    <template #trigger>
                                                        <button>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path
                                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            </svg>
                                                        </button>
                                                    </template>
                                                    <template #content>
                                                        <button
                                                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                                                            @click="editing = true">
                                                            Edit
                                                        </button>
                                                    </template>
                                                </Dropdown>
                                            </div>
                                            <form v-if="editing"
                                                  @submit.prevent="form.put(route('admin.top-bar-settings-update', headerNavBarContent.id), { onSuccess: () => editing = false })">
                                                <div class="mt-2">
                                                    <label :for="form.first_col_name" class="font-bold text-blue-800">
                                                        First col name
                                                    </label>
                                                    <input
                                                        v-model="form.first_col_name"
                                                        :id="form.first_col_name"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.first_col_name" class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.first_col_href" class="font-bold text-blue-800">
                                                        First col href
                                                    </label>
                                                    <input
                                                        :id="form.first_col_href"
                                                        v-model="form.first_col_href"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.first_col_name" class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.first_col_href_content"
                                                           class="font-bold text-blue-800">
                                                        First col href content
                                                    </label>
                                                    <input
                                                        :id="form.first_col_href_content"
                                                        v-model="form.first_col_href_content"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.first_col_href_content"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.second_col_name" class="font-bold text-blue-800">
                                                        Second col name
                                                    </label>
                                                    <input
                                                        :id="form.second_col_name" v-model="form.second_col_name"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.second_col_name" class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.second_col_href" class="font-bold text-blue-800">
                                                        Second col href
                                                    </label>
                                                    <input
                                                        :id="form.second_col_href" v-model="form.second_col_href"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.second_col_href" class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.second_col_href_content"
                                                           class="font-bold text-blue-800">
                                                        Second col href content
                                                    </label>
                                                    <input
                                                        :id="form.second_col_href_content"
                                                        v-model="form.second_col_href_content"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.second_col_href_content"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.first_soc_button_style"
                                                           class="font-bold text-blue-800">
                                                        First soc button style
                                                    </label>
                                                    <input
                                                        :id="form.first_soc_button_style"
                                                        v-model="form.first_soc_button_style"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.first_soc_button_style"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.first_soc_button_href"
                                                           class="font-bold text-blue-800">
                                                        First soc button href
                                                    </label>
                                                    <input
                                                        :id="form.first_soc_button_href"
                                                        v-model="form.first_soc_button_href"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.first_soc_button_href"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.second_soc_button_style"
                                                           class="font-bold text-blue-800">
                                                        Second soc button style
                                                    </label>
                                                    <input
                                                        :id="form.second_soc_button_style"
                                                        v-model="form.second_soc_button_style"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.second_soc_button_style"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.second_soc_button_href"
                                                           class="font-bold text-blue-800">
                                                        Second soc button href
                                                    </label>
                                                    <input
                                                        :id="form.second_soc_button_href"
                                                        v-model="form.second_soc_button_href"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.second_soc_button_href"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.third_soc_button_style"
                                                           class="font-bold text-blue-800">
                                                        Third soc button style
                                                    </label>
                                                    <input
                                                        :id="form.third_soc_button_style"
                                                        v-model="form.third_soc_button_style"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.third_soc_button_style"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.third_soc_button_href"
                                                           class="font-bold text-blue-800">
                                                        Third soc button href
                                                    </label>
                                                    <input
                                                        :id="form.third_soc_button_href"
                                                        v-model="form.third_soc_button_href"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.third_soc_button_href"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.fourth_soc_button_style"
                                                           class="font-bold text-blue-800">
                                                        Fourth soc button style
                                                    </label>
                                                    <input
                                                        :id="form.fourth_soc_button_style"
                                                        v-model="form.fourth_soc_button_style"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.fourth_soc_button_style"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.fourth_soc_button_href"
                                                           class="font-bold text-blue-800">
                                                        Fourth soc button href
                                                    </label>
                                                    <input
                                                        :id="form.fourth_soc_button_href"
                                                        v-model="form.fourth_soc_button_href"
                                                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3"
                                                    >
                                                    <InputError :message="form.errors.fourth_soc_button_href"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="mt-2">
                                                    <label :for="form.login_button_status"
                                                           class="font-bold text-blue-800">
                                                        Login button status
                                                    </label>
                                                    <select
                                                        :id="form.login_button_status"
                                                        class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 p-3'
                                                        v-model='form.login_button_status'>
                                                        <option value=1>true</option>
                                                        <option value=0>false</option>
                                                    </select>
                                                    <InputError :message="form.errors.login_button_status"
                                                                class="mt-2"/>
                                                </div>
                                                <div class="space-x-2">
                                                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                                                    <button class="mt-4"
                                                            @click="editing = false; form.reset(); form.clearErrors()">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">First col href - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.first_col_href }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">First col href content - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.first_col_href_content }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Second col name - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.second_col_name }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Second col href - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.second_col_href }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Second col href content - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.second_col_href_content }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">First soc button style - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.first_soc_button_style }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">First soc button href - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.first_soc_button_href }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Second soc button style - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.second_soc_button_style }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Second soc button href - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.second_soc_button_href }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Third soc button style - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.third_soc_button_style }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Third soc button href - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.third_soc_button_href }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Fourth soc button style - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.fourth_soc_button_style }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Fourth soc button href - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.fourth_soc_button_href }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <div class="pr-2">
                                                    <p class="mt-4 text-lg text-black">Login button status - </p>
                                                </div>
                                                <div>
                                                    <p class="mt-4 text-lg text-red-500">
                                                        {{ headerNavBarContent.login_button_status ? 'true' : 'false' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-4 mt-8 border-b-1 border-blueGray-500 border-dotted"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
