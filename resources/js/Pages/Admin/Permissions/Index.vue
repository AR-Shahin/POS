<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';

defineProps({
    permissions: Object,
});
</script>

<template>
    <Head title="Permissions" />

    <AdminLayout>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Permissions</h2>
            <Link :href="route('admin.permissions.create')">
                <Button>Create Permission</Button>
            </Link>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>ID</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead class="text-right">Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="permission in permissions.data" :key="permission.id">
                        <TableCell class="font-medium">{{ permission.id }}</TableCell>
                        <TableCell>{{ permission.name }}</TableCell>
                        <TableCell class="text-right">
                            <div class="flex justify-end space-x-2">
                                <Link :href="route('admin.permissions.edit', permission.id)">
                                    <Button variant="outline" size="sm">Edit</Button>
                                </Link>
                                <Link :href="route('admin.permissions.destroy', permission.id)" method="delete" as="button">
                                    <Button variant="destructive" size="sm">Delete</Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>
                    <TableRow v-if="permissions.data.length === 0">
                        <TableCell colspan="3" class="text-center py-8 text-gray-500">No permissions found.</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
            
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between" v-if="permissions.links">
                <span class="text-sm text-gray-700 dark:text-gray-300">
                    Showing {{ permissions.from }} to {{ permissions.to }} of {{ permissions.total }} results
                </span>
                <div class="flex space-x-1">
                    <template v-for="(link, index) in permissions.links" :key="index">
                        <Link v-if="link.url" :href="link.url" :class="[
                            'px-3 py-1 border rounded text-sm',
                            link.active ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700'
                        ]" v-html="link.label"></Link>
                        <span v-else class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-400 bg-gray-50 dark:bg-gray-900 dark:border-gray-700" v-html="link.label"></span>
                    </template>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
