<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
    },
    phpVersion: {
        type: String,
    },
});

const stats = ref([
    { label: 'Transactions Processed', value: '10M+' },
    { label: 'Active Users', value: '50K+' },
    { label: 'Uptime', value: '99.9%' },
]);

const features = ref([
    {
        icon: '💳',
        title: 'Fast Checkout',
        description: 'Lightning-quick payment processing with real-time inventory updates',
    },
    {
        icon: '📊',
        title: 'Advanced Analytics',
        description: 'Deep insights into sales patterns, customer behavior, and trends',
    },
    {
        icon: '🔒',
        title: 'Bank-Level Security',
        description: 'Enterprise-grade encryption and compliance with PCI DSS standards',
    },
    {
        icon: '📱',
        title: 'Mobile Ready',
        description: 'Full functionality on tablets and mobile devices for on-the-go management',
    },
    {
        icon: '🌍',
        title: 'Multi-Channel',
        description: 'Seamlessly manage in-store, online, and marketplace sales',
    },
    {
        icon: '⚡',
        title: 'Lightning Fast',
        description: 'Optimized performance with sub-100ms response times',
    },
]);
</script>

<template>
    <Head title="Welcome - Modern POS System" />
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white/90 dark:text-white/90">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 flex min-h-screen flex-col">
            <!-- Navigation Header -->
            <nav class="border-b border-white/5 backdrop-blur-md sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                            P
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                            ModernPOS
                        </span>
                    </div>

                    <div v-if="canLogin" class="flex gap-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="px-6 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition text-white font-medium"
                        >
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="px-6 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition text-white font-medium"
                            >
                                Log in
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 transition text-white font-medium"
                            >
                                Get Started
                            </Link>
                        </template>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <section class="flex-1 flex items-center justify-center px-6 py-20">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="mb-6 inline-block">
                        <span class="px-4 py-2 rounded-full bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border border-blue-500/30 text-blue-300 text-sm font-medium">
                            🚀 The Future of Retail Commerce
                        </span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent">
                            Transform Your Sales
                        </span>
                        <br>
                        <span class="text-white">Experience Excellence</span>
                    </h1>

                    <p class="text-lg md:text-xl text-gray-300 mb-12 max-w-2xl mx-auto leading-relaxed">
                        Meet the revolutionary point-of-sale system designed for modern businesses. Lightning-fast, secure, and built for growth.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="px-8 py-4 rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 transition text-white font-semibold text-lg shadow-lg shadow-blue-500/50 hover:shadow-blue-500/75"
                        >
                            Start Free Trial
                        </Link>
                        <a
                            href="#features"
                            class="px-8 py-4 rounded-lg border border-white/20 hover:border-white/40 transition text-white font-semibold text-lg hover:bg-white/5"
                        >
                            Learn More
                        </a>
                    </div>

                    <!-- Hero Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-16 pt-16 border-t border-white/10">
                        <div v-for="stat in stats" :key="stat.label" class="text-center">
                            <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-2">
                                {{ stat.value }}
                            </div>
                            <p class="text-gray-400 text-sm">{{ stat.label }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Features Section -->
        <section id="features" class="relative z-10 py-24 px-6 border-t border-white/5">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                            Powerful Features
                        </span>
                    </h2>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                        Everything you need to run your business efficiently and profitably
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        v-for="feature in features"
                        :key="feature.title"
                        class="group relative p-8 rounded-2xl border border-white/10 hover:border-white/30 bg-gradient-to-br from-white/5 to-transparent hover:from-white/10 hover:to-white/5 transition duration-300 hover:shadow-lg hover:shadow-cyan-500/20"
                    >
                        <div class="text-5xl mb-4">{{ feature.icon }}</div>
                        <h3 class="text-xl font-semibold text-white mb-3">{{ feature.title }}</h3>
                        <p class="text-gray-400">{{ feature.description }}</p>
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 opacity-0 group-hover:opacity-5 transition duration-300"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative z-10 py-24 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div class="bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border border-blue-500/30 rounded-3xl p-12 md:p-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white">
                        Ready to revolutionize your sales?
                    </h2>
                    <p class="text-gray-300 text-lg mb-8 max-w-2xl mx-auto">
                        Join thousands of successful retailers using ModernPOS to grow their business
                    </p>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="inline-block px-10 py-4 rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 transition text-white font-semibold text-lg shadow-lg shadow-blue-500/50 hover:shadow-blue-500/75"
                    >
                        Get Started Today
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-10 border-t border-white/5 py-12 px-6 mt-12">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 mb-12">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                P
                            </div>
                            <span class="font-bold text-white">ModernPOS</span>
                        </div>
                        <p class="text-gray-400 text-sm">The modern point-of-sale for forward-thinking businesses.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Product</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">Features</a></li>
                            <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                            <li><a href="#" class="hover:text-white transition">Security</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Company</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">About</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Legal</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">Privacy</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms</a></li>
                            <li><a href="#" class="hover:text-white transition">Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm">
                    <p>&copy; 2026 ModernPOS. All rights reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition">Twitter</a>
                        <a href="#" class="hover:text-white transition">LinkedIn</a>
                        <a href="#" class="hover:text-white transition">GitHub</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
