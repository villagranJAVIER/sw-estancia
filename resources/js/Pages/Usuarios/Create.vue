<template>
    <app-layout title="Agregar usuario">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ titulo }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-left">

                <div class="bg-gray-50 shadow-2xl p-8">
                    <form class="flex flex-col items-center p-16" @submit.prevent="guardar">

                        <jet-label for="name" value="Nombre:" />
                        <jet-input id="name" class="px-5 py-3 w-96 border border-gray-600 rounded" v-model="form.name"
                            :class="{ 'is-invalid': form.errors.name }" required placeholder="Nombre" />
                        <jet-input-error :message="form.errors.name" />

                        <jet-label for="apellidoP" value="Apellido paterno:" class="mt-6" />
                        <jet-input id="apellidoP" class="px-5 py-3 w-96 border border-gray-600 rounded"
                            v-model="form.apellidoP" :class="{ 'is-invalid': form.errors.apellidoP }" required
                            placeholder="Apellido paterno" />
                        <jet-input-error :message="form.errors.apellidoP" />

                        <jet-label for="apellidoM" value="Apellido materno:" class="mt-6" />
                        <jet-input id="apellidoM" class="px-5 py-3 w-96 border border-gray-600 rounded"
                            v-model="form.apellidoM" :class="{ 'is-invalid': form.errors.apellidoM }" required
                            placeholder="Apellido materno" />
                        <jet-input-error :message="form.errors.apellidoM" />

                        <jet-label for="id_universidad" value="Universidad:" class="mt-6" />
                        <select class="mt-1 block w-2/5" id="id_universidad" v-model="form.id_universidad" autofocus>
                            <option value="">Selecciona universidad</option>
                            <option v-for="universidad in universidades.data" :value="universidad.id">
                                {{ universidad.nombre }}
                            </option>
                        </select>
                        <jet-input-error :message="form.errors.id_universidad" />

                        <jet-label for="tipo" value="Tipo de usuario:" class="mt-6" />
                        <select class="mt-1 block w-2/5" id="tipo" v-model="form.tipo" autofocus required>
                            <option value="">Selecciona tipo</option>
                            <option value="1">Administrador</option>
                            <option value="2">Asistente</option>
                            <option value="3">Maestro</option>
                            <option value="4">Estudiante</option>
                        </select>
                        <jet-input-error :message="form.errors.tipo" />

                        <jet-label for="email" value="Correo electronico:" class="mt-6" />
                        <jet-input id="email" class="px-5 py-3 w-96 border border-gray-600 rounded" type="email"
                            v-model="form.email" :class="{ 'is-invalid': form.errors.email }" required
                            placeholder="Correo electronico" />
                        <jet-input-error :message="form.errors.email" />

                        <jet-label for="password" value="Contraseña:" class="mt-6" />
                        <jet-input id="password" class="px-5 py-3 w-96 border border-gray-600 rounded" type="password"
                            v-model="form.password" :class="{ 'is-invalid': form.errors.password }" required
                            placeholder="Contraseña" />
                        <jet-input-error :message="form.errors.password" />

                        <div class="flex items-center justify-between mt-4 w-96">
                            <Link :href="route(`${routeName}index`)"
                                class="underline text-sm text-gray-600 hover:text-gray-900">
                            Cancelar
                            </Link>

                            <jet-button @click="guardar" class="ml-4" :class="{ 'text-white': form.processing }"
                                :disabled="form.processing">
                                <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span> Guardar
                            </jet-button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import JetLabel from "@/Components/Label.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetButton from "@/Components/Button.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    name: "Create",
    props: {
        titulo: { type: String, required: true },
        routeName: { type: String, required: true },
        universidades: { type: Object, required: true },
    },
    components: {
        AppLayout,
        Link,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
    },
    setup(props) {

        const form = useForm({ name: '', apellidoP: '', apellidoM: '', id_universidad: '', tipo: '', email: '', password: '' });
        const guardar = () => {
            form.post(route("usuarios.store"));
        };

        return { form, guardar };
    },
};
</script>
  
<style>

</style>