<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

defineOptions({ layout: DashboardLayout });

const page = usePage();

const user = computed(() => page.props.auth?.user);

// Statistics (you can replace these with actual data later)
const stats = [
    { label: 'Total Drivers', value: '24', icon: '👥' },
    { label: 'Active Vehicles', value: '18', icon: '🚗' },
    { label: 'Active Trips', value: '12', icon: '🚕' },
    { label: 'Alerts', value: '3', icon: '⚠️' },
];
</script>

<template>
    <Head title="Dashboard" />

    <div class="space-y-8">
        <!-- Welcome section -->
        <div class="rounded-lg border border-border bg-card p-6 text-card-foreground shadow-sm">
            <h1 class="text-2xl font-bold">Welcome back, {{ user?.name }}! 👋</h1>
            <p class="mt-2 text-muted-foreground">Here's what's happening with your fleet today.</p>
        </div>

        <!-- Statistics grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div v-for="stat in stats" :key="stat.label" class="rounded-lg border border-border bg-card p-6 text-card-foreground shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">{{ stat.label }}</p>
                        <p class="mt-2 text-3xl font-bold">{{ stat.value }}</p>
                    </div>
                    <div class="text-4xl">{{ stat.icon }}</div>
                </div>
            </div>
        </div>

        <!-- Recent activity -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent trips -->
            <div class="rounded-lg border border-border bg-card p-6 text-card-foreground shadow-sm">
                <h2 class="mb-4 text-lg font-semibold">Recent Trips</h2>
                <div class="space-y-3">
                    <div v-for="i in 3" :key="i" class="flex items-center justify-between border-b border-border py-2 last:border-b-0">
                        <div class="flex-1">
                            <p class="text-sm font-medium">Trip #{{ 1000 + i }}</p>
                            <p class="text-xs text-muted-foreground">From: New York → To: Boston</p>
                        </div>
                        <span class="rounded-full bg-green-500/20 px-2 py-1 text-xs font-medium text-green-400">Completed</span>
                    </div>
                </div>
            </div>

            <!-- Fleet status -->
            <div class="rounded-lg border border-border bg-card p-6 text-card-foreground shadow-sm">
                <h2 class="mb-4 text-lg font-semibold">Fleet Status</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-muted-foreground">Active</span>
                        <div class="flex items-center">
                            <div class="mr-2 h-2 w-2 rounded-full bg-green-500" />
                            <span class="text-sm font-semibold">18</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-muted-foreground">In Maintenance</span>
                        <div class="flex items-center">
                            <div class="mr-2 h-2 w-2 rounded-full bg-yellow-500" />
                            <span class="text-sm font-semibold">2</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-muted-foreground">Offline</span>
                        <div class="flex items-center">
                            <div class="mr-2 h-2 w-2 rounded-full bg-red-500" />
                            <span class="text-sm font-semibold">1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
