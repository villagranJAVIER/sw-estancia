<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    apellidoP: '',
    apellidoM: '',
    id_universidad: '',
    tipo: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

defineProps({
    universidades: {
      type: Object,
      default: {},
      required: true,
    },
});

const submit = () => {
    form.tipo = 4;
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <form @submit.prevent="submit">
            <div class="mt-2">
                <InputLabel for="name" value="Nombre" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.nombre" />
            </div>

            <div class="mt-2">
                <InputLabel for="apellidoP" value="Apellido Paterno" />
                <TextInput
                    id="apellidoP"
                    v-model="form.apellidoP"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="apellidoP"
                />
                <InputError class="mt-2" :message="form.errors.apellidoP" />
            </div>
            <div class="mt-2">
                <InputLabel for="apellidoM" value="Apellido Materno" />
                <TextInput
                    id="apellidoM"
                    v-model="form.apellidoM"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="apellidoM"
                />
                <InputError class="mt-2" :message="form.errors.apellidoM" />
            </div>

            <div class="mt-2">
                <InputLabel for="id_universidad" value="Universidad:" />
                <select
                    class="mt-1 block w-full"
                    id="id_universidad"
                    v-model="form.id_universidad"
                    autofocus
                >
                    <option value="">Selecciona universidad</option>
                    <option v-for="universidad in universidades" :value="universidad.id">
                        {{ universidad.nombre }}
                    </option>
                </select>
                <InputError class="mt-2" :message="form.errors.id_universidad" />
                <!-- <TextInput
                    id="id_universidad"
                    v-model="form.id_universidad"
                    type="text"
                    class="mt-1 block w-full"
                    autofocus
                    autocomplete="id_universidad"
                />
                <InputError class="mt-2" :message="form.errors.id_universidad" /> -->
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Contraseña" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirma Contraseña" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-between mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Iniciar Sesión
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registrarse
                </PrimaryButton>
            </div>
        </form>
        
        
    </AuthenticationCard>
</template>
