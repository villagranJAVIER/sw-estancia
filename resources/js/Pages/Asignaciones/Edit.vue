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
                    <form class="flex flex-col items-center p-16" @submit.prevent="guardar"
                        enctype="multipart/form-data">

                        <h1>ID estudiante:</h1>
                        <div class="text-center mt-5 mb-10 border-2 border-neutral-900 p-2 rounded-xl w-52">
                            <jet-label for="campo1" :value="asignacion.id_estudiante" />
                        </div>

                        <div class="text-center mb-10">
                            <jet-label for="id_maestro" value="Maestro: " />
                            <select class="mt-1 block w-auto" id="id_maestro" v-model="form.id_maestro" autofocus
                                required>
                                <option value="">Selecciona maestro</option>
                                <option v-for="item in maestros.data" :value="item.id">{{ item.name }}</option>
                            </select>
                            <jet-input-error :message="form.errors.id_maestro" />


                        </div>



                        <div class="flex items-center justify-between mt-4 w-96">
                            <Link
                                :href="route('estudiantes.show', asignacion.id_estudiante)"
                                class="underline text-sm text-gray-600 hover:text-gray-900"
                                >
                                Cancelar
                            </Link>

                            <jet-button @click="guardar" class="ml-4" :class="{ 'text-white': form.processing }"
                                :disabled="form.processing">
                                <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span> Guardar
                            </jet-button>

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
                                " v-if="!asignacion.deleted_at" type="button" @click="eliminar">
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
        asignacion: { type: Object, required: true },
        maestros: { type: Object, required: true },
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
        const form = useForm({ ...props.asignacion });

        const guardar = () => {
            form.put(route("asignaciones.update", props.asignacion.id));
        };

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
                    form.delete(route("asignaciones.destroy", props.asignacion.id));
                }
            });
        };
        return { form, guardar, eliminar };
    },
};
</script>