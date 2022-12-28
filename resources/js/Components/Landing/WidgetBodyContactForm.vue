<script setup>
defineProps(['widgetBodyContactForm']);
</script>
<template>
    <div class="flex-auto p-5 lg:p-10">
        <h4 class="text-2xl font-semibold">
            {{ widgetBodyContactForm.title }}
        </h4>
        <p class="leading-relaxed mt-1 mb-4 text-blueGray-500">
            {{ widgetBodyContactForm.content }}
        </p>
        <div class="relative w-full mb-3 mt-8">
            <label
                class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                htmlFor="full-name"
            >
                Full Name
            </label>
            <input
                type="text"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                placeholder="Full Name"
            />
        </div>

        <div class="relative w-full mb-3">
            <label
                class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                htmlFor="email"
            >
                Email
            </label>
            <input
                type="email"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                placeholder="Email"
            />
        </div>

        <div class="relative w-full mb-3">
            <label
                class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                htmlFor="message"
            >
                Message
            </label>
            <textarea
                rows="4"
                cols="80"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                placeholder="Type a message..."
            />
        </div>
        <div class="text-center mt-6">
            <button
                class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                type="button"
            >
                Send Message
            </button>
        </div>
    </div>

</template>
