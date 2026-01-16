<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div class="w-full overflow-hidden bg-blue-200 px-6 py-4 shadow-2xl sm:max-w-lg sm:rounded-lg">
            <div class="mb-4">
                <Link href="/">
                    <ApplicationLogo class="mx-auto h-20 w-auto" />
                </Link>
            </div>
            <slot />
        </div>
    </div>
</template>
