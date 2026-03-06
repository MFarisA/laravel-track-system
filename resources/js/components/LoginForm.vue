<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';

const props = defineProps<{
    class?: HTMLAttributes['class'];
    form: any;
    submit: () => void;
}>();
</script>

<template>
    <form @submit.prevent="submit" :class="cn('flex flex-col gap-6', props.class)">
        <div class="flex flex-col items-center gap-1 text-center">
            <h1 class="text-2xl font-bold">Login to your account</h1>
            <p class="text-muted-foreground text-sm text-balance">
                Enter your email below to login to your account
            </p>
        </div>

        <!-- Flash message -->
        <div v-if="$page.props.flash?.success" class="text-sm text-green-400 bg-green-500/10 border border-green-500/20 rounded-lg px-4 py-3">
            {{ $page.props.flash.success }}
        </div>

        <div class="grid gap-6">
            <!-- Email -->
            <div class="grid gap-2">
                <label for="email" class="text-sm font-medium leading-none">Email</label>
                <Input
                    id="email"
                    v-model="form.email"
                    type="email"
                    placeholder="you@example.com"
                    autocomplete="email"
                    required
                    :class="{ 'border-destructive': form.errors.email }"
                />
                <p v-if="form.errors.email" class="text-xs text-destructive">{{ form.errors.email }}</p>
            </div>

            <!-- Password -->
            <div class="grid gap-2">
                <div class="flex items-center">
                    <label for="password" class="text-sm font-medium leading-none">Password</label>
                </div>
                <Input
                    id="password"
                    v-model="form.password"
                    type="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    required
                    :class="{ 'border-destructive': form.errors.password }"
                />
                <p v-if="form.errors.password" class="text-xs text-destructive">{{ form.errors.password }}</p>
            </div>

            <!-- Remember me -->
            <div class="flex items-center gap-2">
                <input
                    id="remember"
                    v-model="form.remember"
                    type="checkbox"
                    class="rounded border-border"
                />
                <label for="remember" class="text-sm text-muted-foreground cursor-pointer">Remember me</label>
            </div>

            <!-- Submit -->
            <Button type="submit" class="w-full" :disabled="form.processing">
                <span v-if="form.processing">Signing in…</span>
                <span v-else>Login</span>
            </Button>
        </div>
    </form>
</template>
