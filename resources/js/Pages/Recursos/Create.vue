<template>
    <app-layout title="Subir documento">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ titulo }} - {{ estudiante }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-left">

                <div class="bg-gray-50 shadow-2xl p-8">
                    <form class="flex flex-col items-center p-16" @submit.prevent="guardar"
                        enctype="multipart/form-data">

                        <jet-label for="nombre_documento" value="Nombre documento:" />
                        <jet-input id="nombre_documento" class="px-5 py-3 w-96 border border-gray-600 rounded" v-model="form.nombre_documento"
                            :class="{ 'is-invalid': form.errors.nombre_documento }" required placeholder="Nombre documento" />
                        <jet-input-error :message="form.errors.nombre_documento" />


                        <div class="w-96 mt-7 text-center">
                            <jet-label for="campo4" value="Selecciona un archivo:" />
                            <jet-input
                                class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                type="file" @input="form.URL_documento = $event.target.files[0]" />
                            <jet-input-error :message="form.errors.URL_documento" />
                        </div>

                        <div class="flex items-center justify-between mt-14 w-96">
                            <Link :href="route('estudiantes.show', estudiante)"
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
        estudiante: { type: String, required: true },
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
        const form = useForm({ nombre_documento: "", URL_documento: "", id_estudiante: "" });

        const guardar = () => {
            form.id_estudiante = props.estudiante;
            form.post(route("recursos.store"));
        };
        return { form, guardar };
    },
};
</script>