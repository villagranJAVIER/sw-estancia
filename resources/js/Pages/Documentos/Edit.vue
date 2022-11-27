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
                        <jet-label for="campo1" value="Nombre Documento:" />
                        <jet-input id="campo1" class="px-5 py-3 w-96 border border-gray-600 rounded"
                            v-model="form.nombre_documento" :class="{ 'is-invalid': form.errors.nombre_documento }"
                            placeholder="Nombre documento" />
                        <jet-input-error :message="form.errors.nombre_documento" />

                        <div class="flex items-center justify-between mt-4 w-96">
                            <Link :href="route(`${routeName}index`)"
                                class="underline text-sm text-gray-600 hover:text-gray-900">
                            Cancelar
                            </Link>
                            <div class="ml-4">
                                <button class="
                                  p-1
                                  border-2
                                  border-red-500
                                  text-red-500
                                  bg-red-100
                                  hover:bg-red-200
                                  font-bold
                                  rounded-xl
                                " v-if="!documentos.deleted_at" type="button" @click="eliminar">
                                    <i class="bi bi-trash"></i> Eliminar Registro
                                </button>
                            </div>
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
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

export default {
    name: "Edit",
    props: {
        titulo: { type: String, required: true },
        documentos: { type: Object, required: true },
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
        const form = useForm({ ...props.documentos });

        const eliminar = () => {
            Swal.fire({
                title: "¿Esta seguro?",
                text: "Esta acción no se puede revertir",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Si!, eliminar registro!",
            }).then((res) => {
                if (res.isConfirmed) {
                    form.delete(route("documentos.destroy", props.documentos.id));
                }
            });
        };
        return { form, eliminar };
    },
};
</script>