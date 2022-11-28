<template>
    <app-layout title="Editar Universidades">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ titulo }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-left">

                <div class="bg-gray-50 shadow-2xl p-8">
                    <form class="flex flex-col items-center p-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text"
                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <line x1="9" y1="9" x2="10" y2="9" />
                            <line x1="9" y1="13" x2="15" y2="13" />
                            <line x1="9" y1="17" x2="15" y2="17" />
                        </svg>
                        <div class="text-center mt-5 mb-10 border-2 border-neutral-900 p-2 rounded-xl w-52">
                            <jet-label for="campo1" :value="form.nombre_documento" />
                        </div>
                        <div class="text-center mb-10 border-2 border-neutral-900 p-2 rounded-xl w-52">
                            <jet-label for="campo1" :value="form.URL_documento" />
                        </div>

                        <div class="text-center mb-10">
                            <jet-label for="estatus" value="Estatus: " />
                            <select class="mt-1 block w-auto" id="estatus" v-model="form.estatus" autofocus required>
                                <option value="">Selecciona estatus</option>
                                <option value="Capturando">Capturando</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                            <jet-input-error :message="form.errors.estatus" />
                        </div>

                        <div class="flex flex-col items-center text-center mb-10">
                            <jet-label for="comentarios" value="Comentarios: " />

                            
                            <textarea v-model="form.comentarios" :class="{ 'is-invalid': form.errors.comentarios }"
                                id="comentarios" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ingresa tus comentarios">
                            </textarea>
                            <jet-input-error :message="form.errors.comentarios" />

                        </div>

                        <div class="flex items-center justify-between mt-4 w-96">

                            <Link 
                                :href="route('estudiantes.show', doc.id_estudiante)"
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
    name: "Edit",
    props: {
        titulo: { type: String, required: true },
        doc: { type: Object, required: true },
        routeName: { type: String, required: true },
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
        const form = useForm({ ...props.doc });
        const guardar = () => {
            form.put(route("estudiantes.update", props.doc.id));
        };

        return { form, guardar };
    },
};
</script>