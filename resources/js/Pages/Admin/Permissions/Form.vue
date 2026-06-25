<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const props = defineProps({
    permission: {
        type: Object,
        default: () => ({ id: null, name: '' }),
    },
});

const form = useForm({
    name: props.permission.name,
});

const submit = () => {
    if (props.permission.id) {
        form.put(route('admin.permissions.update', props.permission.id));
    } else {
        form.post(route('admin.permissions.store'));
    }
};
</script>

<template>
    <Head :title="permission.id ? 'Edit Permission' : 'Create Permission'" />

    <AdminLayout>
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ permission.id ? 'Edit Permission' : 'Create Permission' }}
                </h2>
                <Link :href="route('admin.permissions.index')">
                    <Button variant="outline">Back to List</Button>
                </Link>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <form @submit.prevent="submit" class="space-y-4">
                    <div class="space-y-2">
                        <Label for="name">Permission Name</Label>
                        <Input 
                            id="name" 
                            v-model="form.name" 
                            type="text" 
                            placeholder="e.g. edit articles" 
                            required 
                            autofocus 
                        />
                        <p v-if="form.errors.name" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.name }}</p>
                    </div>

                    <div class="flex justify-end pt-4">
                        <Button type="submit" :disabled="form.processing">
                            {{ form.processing ? 'Saving...' : 'Save Permission' }}
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
