<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{
    title?: string;
}>();
</script>

<template>
    <Head :title="title" />

    <div class="flex min-h-screen flex-col items-center justify-center bg-background px-4">
        <!-- Card -->
        <div class="w-full max-w-md rounded-2xl border border-border bg-card p-8 text-card-foreground shadow-sm">
            <slot />
        </div>
    </div>
</template>
