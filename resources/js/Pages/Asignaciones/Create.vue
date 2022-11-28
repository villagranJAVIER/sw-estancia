<template>
    <app-layout title="Asignacion">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ titulo }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-left">

                <div class="bg-gray-50 shadow-2xl p-8">
                    <form class="flex flex-col items-center p-16" @submit.prevent="guardar">
                        <h1>Estudiante</h1>
                        <div class="text-center mt-5 mb-10 border-2 border-neutral-900 p-2 rounded-xl w-52">
                            <jet-label for="campo1" :value="estudiante.name" />
                        </div>

                        <div class="text-center mb-10">
                            <jet-label for="id_maestro" value="Maestro: " />
                            <select class="mt-1 block w-auto" id="id_maestro" v-model="form.id_maestro" autofocus required>
                                <option value="">Selecciona maestro</option>
                                <option v-for="item in usuarios.data" :value="item.id">{{item.name}}</option>
                            </select>
                            <jet-input-error :message="form.errors.id_maestro" />


                        </div>
                      
                      

                      <div class="flex items-center justify-between mt-4 w-96">
                          <Link
                              :href="route('estudiantes.index')"
                              class="underline text-sm text-gray-600 hover:text-gray-900"
                              >
                              Cancelar
                          </Link>

                          <jet-button
                              @click="guardar"
                              class="ml-4"
                              :class="{ 'text-white': form.processing }"
                              :disabled="form.processing"
                              >
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
        usuarios: { type: Object, required: true },
        estudiante: { type: Object, required: true },
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
        const form = useForm({ id_estudiante: "", id_maestro: "" });
        const guardar = () => {
            form.id_estudiante = props.estudiante.id;
            form.post(route("asignaciones.store"));
        };

        return { form, guardar };
    },
};
</script>