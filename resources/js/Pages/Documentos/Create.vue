<template>
  <app-layout title="Crear espacio">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ titulo }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-left">

        <div class="bg-gray-50 shadow-2xl p-8">
          <form class="flex flex-col items-center p-16" @submit.prevent="guardar" enctype="multipart/form-data">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="44"
              height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round"
              stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M14 3v4a1 1 0 0 0 1 1h4" />
              <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
              <line x1="9" y1="9" x2="10" y2="9" />
              <line x1="9" y1="13" x2="15" y2="13" />
              <line x1="9" y1="17" x2="15" y2="17" />
            </svg>
            <h1>Nombre documento: {{ nombre_doc }}</h1>


            <div class="w-96 mt-7 text-center">
              <jet-label for="campo4" value="Selecciona un archivo:" />
              <jet-input
                class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                type="file" @input="form.URL_documento = $event.target.files[0]" />
                <jet-input-error :message="form.errors.URL_documento" />
                <jet-input-error :message="form.errors.nombre_documento" />
            </div>

            <div class="flex items-center justify-between mt-14 w-96">
              <Link :href="route(`${routeName}index`)" class="underline text-sm text-gray-600 hover:text-gray-900">
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
    nombre_doc: { type: String, required: true },
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
    const form = useForm({ nombre_documento: "", URL_documento: "", estatus: "", comentarios: "", id_estudiante: "" });

    const guardar = () => {
      form.nombre_documento = props.nombre_doc;
      form.estatus = "Capturando";
      form.comentarios = "Sin comentarios";
      form.id_estudiante = 0;
      form.post(route("documentos.store"));
    };
    return { form, guardar };
  },
};
</script>