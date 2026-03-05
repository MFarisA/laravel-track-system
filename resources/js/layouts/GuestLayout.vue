<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{
    title?: string;
}>();
</script>

<template>
    <Head :title="title" />

    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center px-4">
        <!-- Logo / App Name -->
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-semibold text-gray-800">
                {{ $page.props.appName ?? 'Fleet Tracking' }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">Fleet Management System</p>
        </div>

        <!-- Card -->
        <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <slot />
        </div>
    </div>
</template>
