<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Checkbox } from '@/components/ui/checkbox';

const props = defineProps({
    admin: {
        type: Object,
        default: () => ({ id: null, name: '', email: '', roles: [] }),
    },
    roles: Array,
});

// Extract IDs of currently assigned roles
const assignedRoleIds = props.admin.roles ? props.admin.roles.map(r => r.id) : [];

const form = useForm({
    name: props.admin.name,
    email: props.admin.email,
    password: '',
    password_confirmation: '',
    roles: assignedRoleIds,
});

const submit = () => {
    if (props.admin.id) {
        form.put(route('admin.users.update', props.admin.id));
    } else {
        form.post(route('admin.users.store'));
    }
};

const toggleRole = (id) => {
    const index = form.roles.indexOf(id);
    if (index > -1) {
        form.roles.splice(index, 1);
    } else {
        form.roles.push(id);
    }
};
</script>

<template>
    <Head :title="admin.id ? 'Edit Admin' : 'Create Admin'" />

    <AdminLayout>
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ admin.id ? 'Edit Admin' : 'Create Admin' }}
                </h2>
                <Link :href="route('admin.users.index')">
                    <Button variant="outline">Back to List</Button>
                </Link>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <Label for="name">Name</Label>
                            <Input 
                                id="name" 
                                v-model="form.name" 
                                type="text" 
                                placeholder="e.g. John Doe" 
                                required 
                            />
                            <p v-if="form.errors.name" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.name }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="email">Email</Label>
                            <Input 
                                id="email" 
                                v-model="form.email" 
                                type="email" 
                                placeholder="e.g. john@example.com" 
                                required 
                            />
                            <p v-if="form.errors.email" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.email }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="password">Password <span class="text-xs text-gray-500 font-normal" v-if="!admin.id">(Leave blank to use default 'password')</span><span class="text-xs text-gray-500 font-normal" v-else>(Leave blank to keep unchanged)</span></Label>
                            <Input 
                                id="password" 
                                v-model="form.password" 
                                type="password" 
                                placeholder="******" 
                            />
                            <p v-if="form.errors.password" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.password }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="password_confirmation">Confirm Password</Label>
                            <Input 
                                id="password_confirmation" 
                                v-model="form.password_confirmation" 
                                type="password" 
                                placeholder="******" 
                            />
                        </div>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <Label>Roles</Label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <div v-for="role in roles" :key="role.id" class="flex items-center space-x-2">
                                <Checkbox 
                                    :id="`role-${role.id}`" 
                                    :checked="form.roles.includes(role.id)"
                                    @update:checked="toggleRole(role.id)"
                                />
                                <Label :for="`role-${role.id}`" class="font-normal cursor-pointer text-sm">
                                    {{ role.name }}
                                </Label>
                            </div>
                            <div v-if="roles.length === 0" class="text-sm text-gray-500 col-span-full">
                                No roles available.
                            </div>
                        </div>
                        <p v-if="form.errors.roles" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.roles }}</p>
                    </div>

                    <div class="flex justify-end pt-4">
                        <Button type="submit" :disabled="form.processing">
                            {{ form.processing ? 'Saving...' : 'Save Admin' }}
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
