<template>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4 lg:p-8">
        <Head title="Register" />

        <div class="w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[700px] border border-purple-100">
            
            <div class="md:w-1/2 bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900 p-12 text-white flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="mb-8 inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md border border-white/20">
                        <span class="text-2xl">🖋️</span>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight">
                        Start Contributing <br/>
                        <span class="text-purple-300">To the library.</span>
                    </h1>
                    <p class="mt-6 text-purple-100/80 text-lg leading-relaxed max-w-sm">
                        Join our community of readers and curators. Create your account to start managing your library.
                    </p>
                </div>

                <div class="relative z-10 mt-12">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3 text-sm text-purple-200">
                            <div class="w-5 h-5 rounded-full bg-purple-400/20 flex items-center justify-center">✓</div>
                            Personalized Book Shelf
                        </div>
                        <div class="flex items-center gap-3 text-sm text-purple-200">
                            <div class="w-5 h-5 rounded-full bg-purple-400/20 flex items-center justify-center">✓</div>
                            Print-ready PDF Access
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 p-8 lg:p-16 flex flex-col justify-center bg-white">
                <div class="mb-8 text-center md:text-left">
                    <h2 class="text-3xl font-bold text-gray-900">Create Account</h2>
                    <p class="text-gray-500 mt-2">Join the sanctuary today</p>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div class="space-y-1.5">
                        <Label for="name" class="text-xs uppercase tracking-widest font-bold text-gray-500 ml-1">Full Name</Label>
                        <Input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            autofocus
                            placeholder="John Doe"
                            class="h-12 px-4 rounded-xl border-gray-200 focus:ring-4 focus:ring-purple-50 focus:border-purple-600 transition-all"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="space-y-1.5">
                        <Label for="email" class="text-xs uppercase tracking-widest font-bold text-gray-500 ml-1">Email Address</Label>
                        <Input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            placeholder="name@example.com"
                            class="h-12 px-4 rounded-xl border-gray-200 focus:ring-4 focus:ring-purple-50 focus:border-purple-600 transition-all"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <Label for="password" class="text-xs uppercase tracking-widest font-bold text-gray-500 ml-1">Password</Label>
                            <Input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                                class="h-12 rounded-xl border-gray-200 focus:ring-4 focus:ring-purple-50 focus:border-purple-600 transition-all"
                            />
                        </div>
                        <div class="space-y-1.5">
                            <Label for="password_confirmation" class="text-xs uppercase tracking-widest font-bold text-gray-500 ml-1">Confirm</Label>
                            <Input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                required
                                class="h-12 rounded-xl border-gray-200 focus:ring-4 focus:ring-purple-50 focus:border-purple-600 transition-all"
                            />
                        </div>
                        <div class="sm:col-span-2">
                            <InputError :message="form.errors.password" />
                        </div>
                    </div>

                    <Button
                        type="submit"
                        class="w-full h-14 bg-purple-900 hover:bg-purple-800 text-white font-bold rounded-2xl shadow-xl shadow-purple-100 transition-all transform active:scale-[0.98] mt-4 flex items-center justify-center gap-2"
                        :disabled="form.processing"
                    >
                        <Spinner v-if="form.processing" class="w-5 h-5" />
                        <span v-else>Create Account</span>
                    </Button>
                </form>

                <div class="mt-8 text-center text-sm text-gray-500">
                    Already have an account? 
                    <TextLink :href="login()" class="font-bold text-purple-700 hover:text-purple-900 underline decoration-purple-200 underline-offset-4 transition-all">
                        Log in instead
                    </TextLink>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>