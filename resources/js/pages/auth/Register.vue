<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

defineOptions({ layout: GuestLayout });

const form = useForm({
    name: '',
    email: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
    role: 'admin' as 'admin' | 'driver',

    // Driver-only fields
    employee_id: '',
    license_number: '',
    license_expiry: '',
});

const isDriver = computed(() => form.role === 'driver');

function submit() {
    form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}
</script>

<template>
    <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-1">Create account</h2>
        <p class="text-sm text-gray-500 mb-6">Register a new admin or driver account</p>

        <form @submit.prevent="submit" class="space-y-5">
            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input v-model="form.role" type="radio" value="admin" class="border-gray-300" />
                        Admin
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input v-model="form.role" type="radio" value="driver" class="border-gray-300" />
                        Driver
                    </label>
                </div>
                <p v-if="form.errors.role" class="mt-1 text-xs text-red-500">{{ form.errors.role }}</p>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full name</label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    autocomplete="name"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                    :class="{ 'border-red-400': form.errors.name }"
                    placeholder="John Doe"
                />
                <p v-if="form.errors.name" class="mt-1 text-xs text-red-500">{{ form.errors.name }}</p>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    autocomplete="email"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                    :class="{ 'border-red-400': form.errors.email }"
                    placeholder="you@example.com"
                />
                <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone number</label>
                <input
                    id="phone_number"
                    v-model="form.phone_number"
                    type="tel"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                    :class="{ 'border-red-400': form.errors.phone_number }"
                    placeholder="08120000000"
                />
                <p v-if="form.errors.phone_number" class="mt-1 text-xs text-red-500">{{ form.errors.phone_number }}</p>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                    :class="{ 'border-red-400': form.errors.password }"
                    placeholder="Min. 8 characters"
                />
                <p v-if="form.errors.password" class="mt-1 text-xs text-red-500">{{ form.errors.password }}</p>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm password
                </label>
                <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                    placeholder="Repeat password"
                />
            </div>

            <!-- Driver fields -->
            <template v-if="isDriver">
                <div class="border-t border-gray-100 pt-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-4">Driver details</p>

                    <div class="space-y-5">
                        <div>
                            <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Employee ID
                            </label>
                            <input
                                id="employee_id"
                                v-model="form.employee_id"
                                type="text"
                                required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                                :class="{ 'border-red-400': form.errors.employee_id }"
                                placeholder="DRV-001"
                            />
                            <p v-if="form.errors.employee_id" class="mt-1 text-xs text-red-500">{{ form.errors.employee_id }}</p>
                        </div>

                        <div>
                            <label for="license_number" class="block text-sm font-medium text-gray-700 mb-1">
                                License number
                            </label>
                            <input
                                id="license_number"
                                v-model="form.license_number"
                                type="text"
                                required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                                :class="{ 'border-red-400': form.errors.license_number }"
                                placeholder="SIM-A-001"
                            />
                            <p v-if="form.errors.license_number" class="mt-1 text-xs text-red-500">{{ form.errors.license_number }}</p>
                        </div>

                        <div>
                            <label for="license_expiry" class="block text-sm font-medium text-gray-700 mb-1">
                                License expiry
                            </label>
                            <input
                                id="license_expiry"
                                v-model="form.license_expiry"
                                type="date"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                                :class="{ 'border-red-400': form.errors.license_expiry }"
                            />
                            <p v-if="form.errors.license_expiry" class="mt-1 text-xs text-red-500">{{ form.errors.license_expiry }}</p>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Submit -->
            <button
                type="submit"
                :disabled="form.processing"
                class="w-full rounded-lg bg-gray-900 text-white text-sm font-medium py-2.5 px-4 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 disabled:opacity-50 disabled:cursor-not-allowed transition"
            >
                <span v-if="form.processing">Creating account…</span>
                <span v-else>Create account</span>
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            Already have an account?
            <Link href="/login" class="font-medium text-gray-800 hover:underline">Sign in</Link>
        </p>
    </div>
</template>
