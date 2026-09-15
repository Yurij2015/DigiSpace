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
.admin-language-control select { width: 76px; height: 36px; padding: 0 8px; border: 1px solid #cbd5e1; border-radius: 8px; background: #fff; color: #334155; font: 600 13px system-ui, sans-serif; cursor: pointer; }
.admin-language-control select:focus-visible { outline: 2px solid #0ea5e9; outline-offset: 2px; }
</style>
