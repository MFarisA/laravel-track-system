<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import DashboardLayout from '@/layouts/DashboardLayout.vue';

defineOptions({ layout: DashboardLayout });
</script>

<template>
    <Head title="Vehicles" />

    <div class="space-y-4">
        <h1 class="text-2xl font-bold">Vehicles</h1>
        <p class="text-muted-foreground">Halaman Vehicles — konten akan ditambahkan nanti.</p>
    </div>
</template>
