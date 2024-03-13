<script setup>
defineProps(['sectionItems', 'sections'])
</script>

<template>
    <div class="block w-full overflow-x-auto table-custom-responsive">
        {{ sections }}
        <table class="items-center w-full bg-transparent border-collapse border table-auto" aria-label="Sections item">
            <caption class="caption-top font-bold mb-4">
                SECTIONS
            </caption>
            <thead>
            <tr>
                <th class="uppercase px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Id
                </th>
                <th class="uppercase px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Section
                </th>
                <th class="uppercase px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Subcategory
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Subcategory progress
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Subcategory fa-icon
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Item name
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Place name
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Place logo_url
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Place fa_icon
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Period
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Image icon url
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Fa icon
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Value
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Logo url
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Href
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Locales
                </th>
                <th class="uppercase whitespace-nowrap px-4 text-center px-4 bg-blueGray-50 text-blueGray-500 align-middle border border-blueGray-400 py-2 font-semibold text-left hover:bg-sky-200 font-bold text-xs">
                    Links
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="sectionItem in sectionItems" :key="sectionItem.id" class="hover:bg-sky-100">
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    {{ sectionItem.id }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <span v-if="sectionItem.section">{{ sectionItem.section.name }}</span>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <span v-if="sectionItem.subcategory">{{ sectionItem.subcategory.name }}</span>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <span v-if="sectionItem.subcategory">{{ sectionItem.subcategory.progress }}</span>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <span v-if="sectionItem.subcategory">{{ sectionItem.subcategory.fa_icon }}</span>
                </td>
                <td class="px-6 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    {{ sectionItem.name }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <span v-if="sectionItem.place">{{ sectionItem.place.name }}</span>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <span v-if="sectionItem.place">{{ sectionItem.place.logo_url }}</span>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <span v-if="sectionItem.place">{{ sectionItem.place.fa_icon }}</span>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <div v-if="sectionItem.period" v-for="date in sectionItem.period">
                        <div>{{ date }}</div>
                    </div>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    {{ sectionItem.image_icon_url }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    {{ sectionItem.fa_icon }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    {{ sectionItem.value }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    {{ sectionItem.logo_url }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    {{ sectionItem.href }}
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <div v-if="sectionItem.locales" v-for="locale in sectionItem.locales">
                        <div>{{ locale.en.lang_code }} - {{ locale.en.title }} - {{ locale.en.description }}</div>
                        <div>{{ locale.ua.lang_code }} - {{ locale.ua.title }} - {{ locale.ua.description }}</div>
                        <div>{{ locale.pl.lang_code }} - {{ locale.pl.title }} - {{ locale.pl.description }}</div>
                    </div>
                </td>
                <td class="px-4 align-middle border border-blueGray-400 text-x whitespace-nowrap p-4 text-xs">
                    <div v-if="sectionItem.links" v-for="link in sectionItem.links">
                        {{ link.fa_icon }} - {{ link.href }}
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
