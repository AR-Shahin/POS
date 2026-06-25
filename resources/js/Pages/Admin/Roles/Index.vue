<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';

defineProps({
    roles: Object,
});
</script>

<template>
    <Head title="Roles" />

    <AdminLayout>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Roles</h2>
            <Link :href="route('admin.roles.create')">
                <Button>Create Role</Button>
            </Link>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>ID</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Permissions</TableHead>
                        <TableHead class="text-right">Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="role in roles.data" :key="role.id">
                        <TableCell class="font-medium">{{ role.id }}</TableCell>
                        <TableCell>{{ role.name }}</TableCell>
                        <TableCell>
                            <div class="flex flex-wrap gap-1">
                                <Badge v-for="permission in role.permissions.slice(0, 5)" :key="permission.id" variant="secondary">
                                    {{ permission.name }}
                                </Badge>
                                <Badge v-if="role.permissions.length > 5" variant="outline">
                                    +{{ role.permissions.length - 5 }} more
                                </Badge>
                                <span v-if="role.permissions.length === 0" class="text-gray-500 text-sm">None</span>
                            </div>
                        </TableCell>
                        <TableCell class="text-right">
                            <div class="flex justify-end space-x-2">
                                <Link :href="route('admin.roles.edit', role.id)">
                                    <Button variant="outline" size="sm">Edit</Button>
                                </Link>
                                <Link :href="route('admin.roles.destroy', role.id)" method="delete" as="button">
                                    <Button variant="destructive" size="sm">Delete</Button>
                                </Link>
                            </div>
                        </TableCell>
                    </TableRow>
                    <TableRow v-if="roles.data.length === 0">
                        <TableCell colspan="4" class="text-center py-8 text-gray-500">No roles found.</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
            
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between" v-if="roles.links">
                <span class="text-sm text-gray-700 dark:text-gray-300">
                    Showing {{ roles.from }} to {{ roles.to }} of {{ roles.total }} results
                </span>
                <div class="flex space-x-1">
                    <template v-for="(link, index) in roles.links" :key="index">
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
