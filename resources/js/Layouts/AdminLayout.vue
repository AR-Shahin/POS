<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 hidden md:block">
            <div class="h-16 flex items-center px-6 border-b border-gray-200 dark:border-gray-700">
                <span class="text-xl font-bold text-gray-800 dark:text-white">POS Admin</span>
            </div>
            <nav class="p-4 space-y-1">
                <Link :href="route('dashboard')" :class="['flex items-center px-4 py-2 text-sm font-medium rounded-md', route().current('dashboard') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white']">
                    Dashboard
                </Link>
                <Link :href="route('admin.users.index')" :class="['flex items-center px-4 py-2 text-sm font-medium rounded-md', route().current('admin.users.*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white']">
                    Admins
                </Link>
                <Link :href="route('admin.roles.index')" :class="['flex items-center px-4 py-2 text-sm font-medium rounded-md', route().current('admin.roles.*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white']">
                    Roles
                </Link>
                <Link :href="route('admin.permissions.index')" :class="['flex items-center px-4 py-2 text-sm font-medium rounded-md', route().current('admin.permissions.*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white']">
                    Permissions
                </Link>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="md:pl-64 flex flex-col min-h-screen">
            <!-- Header -->
            <header class="h-16 flex items-center justify-between px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center md:hidden">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">POS Admin</span>
                </div>
                <div class="flex-1"></div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ user?.name }}</span>
                    <Link :href="route('logout')" method="post" as="button" class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                        Logout
                    </Link>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
