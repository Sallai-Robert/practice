<template>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4 lg:p-8">
        <Head title="Log in" />

        <div class="w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[600px] border border-purple-100">
            
            <div class="md:w-1/2 bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900 p-12 text-white flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-purple-700/20 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="mb-8 inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 shadow-inner">
                        <span class="text-2xl">📚</span>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight">
                        Welcome back to <br/>
                        <span class="text-purple-300">The Archive.</span>
                    </h1>
                    <p class="mt-6 text-purple-100/80 text-lg leading-relaxed max-w-sm">
                        Access your personal collection of literature and printable manuscripts.
                    </p>
                </div>

                <div class="relative z-10 mt-12">
                    <blockquote class="border-l-2 border-purple-400 pl-4 italic text-purple-200/70 text-sm">
                        "A library is not a luxury but one of the necessities of life."
                    </blockquote>
                </div>
            </div>

            <div class="md:w-1/2 p-8 lg:p-16 flex flex-col justify-center bg-white">
                <div class="mb-10 text-center md:text-left">
                    <h2 class="text-3xl font-bold text-gray-900">Sign In</h2>
                    <p class="text-gray-500 mt-2">Please enter your details to continue</p>
                </div>

                <div v-if="status" class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl text-sm font-medium border border-green-100">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="email" class="text-xs uppercase tracking-widest font-bold text-gray-500 ml-1">Email Address</Label>
                        <Input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            placeholder="name@example.com"
                            class="h-12 px-4 rounded-xl border-gray-200 focus:ring-4 focus:ring-purple-50 focus:border-purple-600 transition-all outline-none"
                        />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between ml-1">
                            <Label for="password" class="text-xs uppercase tracking-widest font-bold text-gray-500">Password</Label>
                            <TextLink v-if="canResetPassword" :href="request()" class="text-xs font-bold text-purple-600 hover:text-purple-800 transition">
                                Forgot?
                            </TextLink>
                        </div>
                        <Input
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            placeholder="••••••••"
                            class="h-12 px-4 rounded-xl border-gray-200 focus:ring-4 focus:ring-purple-50 focus:border-purple-600 transition-all outline-none"
                        />
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between py-2">
                        <label class="flex items-center group cursor-pointer">
                            <Checkbox v-model:checked="form.remember" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500" />
                            <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Keep me signed in</span>
                        </label>
                    </div>

                    <Button
                        type="submit"
                        class="w-full h-14 bg-purple-900 hover:bg-purple-800 text-white font-bold rounded-2xl shadow-xl shadow-purple-100 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2"
                        :disabled="form.processing"
                    >
                        <Spinner v-if="form.processing" class="w-5 h-5" />
                        <span v-else>Enter the Library</span>
                    </Button>
                </form>

                <div v-if="canRegister" class="mt-10 text-center text-sm text-gray-500">
                    Don't have an account? 
                    <TextLink :href="register()" class="font-bold text-purple-700 hover:text-purple-900 underline decoration-purple-200 underline-offset-4 transition-all">
                        Join the community
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
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>