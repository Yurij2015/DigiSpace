<script setup>
import {usePage} from '@inertiajs/vue3';

defineProps({contrast: {type: Boolean, default: false}});
const page = usePage();
const locales = [{code: 'en', label: 'EN'}, {code: 'uk', label: 'UK'}, {code: 'pl', label: 'PL'}];

function switchLocale(event) {
    window.location.assign(event.target.value);
}
</script>

<template>
    <div class="admin-language-control">
        <select aria-label="Language / Мова / Język" data-testid="language-select" @change="switchLocale">
            <option v-for="locale in locales" :key="locale.code"
                    :value="route('locale.switch', {locale: locale.code})"
                    :selected="page.props.locale === locale.code">
                {{ locale.label }}
            </option>
        </select>
    </div>
</template>

<style scoped>
.admin-language-control { flex-shrink: 0; }
.admin-language-control select { width: 76px; height: 36px; padding: 0 24px 0 8px; border: 1px solid #cbd5e1; border-radius: 8px; background-color: #fff; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='none'%3E%3Cpath d='m6 8 4 4 4-4' stroke='%23334155' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 7px center; background-size: 14px 14px; -webkit-appearance: none; appearance: none; color: #334155; font: 600 13px system-ui, sans-serif; cursor: pointer; }
.admin-language-control select:focus-visible { outline: 2px solid #0ea5e9; outline-offset: 2px; }
</style>
