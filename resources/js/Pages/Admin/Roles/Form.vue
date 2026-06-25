<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Checkbox } from '@/components/ui/checkbox';

const props = defineProps({
    role: {
        type: Object,
        default: () => ({ id: null, name: '', permissions: [] }),
    },
    permissions: Array,
});

// Extract IDs of currently assigned permissions
const assignedPermissionIds = props.role.permissions ? props.role.permissions.map(p => p.id) : [];

const form = useForm({
    name: props.role.name,
    permissions: assignedPermissionIds,
});

const submit = () => {
    if (props.role.id) {
        form.put(route('admin.roles.update', props.role.id));
    } else {
        form.post(route('admin.roles.store'));
    }
};

const togglePermission = (id) => {
    const index = form.permissions.indexOf(id);
    if (index > -1) {
        form.permissions.splice(index, 1);
    } else {
        form.permissions.push(id);
    }
};
</script>

<template>
    <Head :title="role.id ? 'Edit Role' : 'Create Role'" />

    <AdminLayout>
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ role.id ? 'Edit Role' : 'Create Role' }}
                </h2>
                <Link :href="route('admin.roles.index')">
                    <Button variant="outline">Back to List</Button>
                </Link>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="name">Role Name</Label>
                        <Input 
                            id="name" 
                            v-model="form.name" 
                            type="text" 
                            placeholder="e.g. Manager" 
                            required 
                            autofocus 
                        />
                        <p v-if="form.errors.name" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.name }}</p>
                    </div>

                    <div class="space-y-3">
                        <Label>Permissions</Label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 border border-gray-200 dark:border-gray-700 p-4 rounded-md bg-gray-50 dark:bg-gray-900/50">
                            <div v-for="permission in permissions" :key="permission.id" class="flex items-center space-x-2">
                                <Checkbox 
                                    :id="`permission-${permission.id}`" 
                                    :checked="form.permissions.includes(permission.id)"
                                    @update:checked="togglePermission(permission.id)"
                                />
                                <Label :for="`permission-${permission.id}`" class="font-normal cursor-pointer text-sm">
                                    {{ permission.name }}
                                </Label>
                            </div>
                            <div v-if="permissions.length === 0" class="text-sm text-gray-500 col-span-full">
                                No permissions available. Please create some permissions first.
                            </div>
                        </div>
                        <p v-if="form.errors.permissions" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.permissions }}</p>
                    </div>

                    <div class="flex justify-end pt-4">
                        <Button type="submit" :disabled="form.processing">
                            {{ form.processing ? 'Saving...' : 'Save Role' }}
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
