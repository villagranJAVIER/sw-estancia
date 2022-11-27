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
                  <form class="flex flex-col items-center p-16" @submit.prevent="guardar">
                      
                      <jet-label for="name" value="Nombre universidad:" />
                      <jet-input
                          class="px-5 py-3 w-96 border border-gray-600 rounded"
                          v-model="form.nombre"
                          :class="{ 'is-invalid': form.errors.nombre }"
                          required
                          placeholder="Nombre universidad"
                      />
                      <jet-input-error :message="form.errors.nombre" />

                      <jet-label for="direccion" value="Dirección:" />
                      <jet-input
                          id="direccion"
                          class="px-5 py-3 w-96 border border-gray-600 rounded"
                          v-model="form.direccion"
                          :class="{ 'is-invalid': form.errors.direccion }"
                          required
                          placeholder="Dirección"
                      />
                      <jet-input-error :message="form.errors.direccion" />

                      <jet-label for="telefono" value="Telefono:" />
                      <jet-input
                          id="telefono"
                          class="px-5 py-3 w-96 border border-gray-600 rounded"
                          v-model="form.telefono"
                          :class="{ 'is-invalid': form.errors.telefono }"
                          required
                          placeholder="Telefono"
                      />
                      <jet-input-error :message="form.errors.telefono" />

                      <div class="flex items-center justify-between mt-4 w-96">
                          <Link
                              :href="route(`${routeName}index`)"
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

                          <div class="ml-4">
                            <button
                              class="
                                p-1
                                border-2
                                border-red-500
                                text-red-500
                                bg-red-100
                                hover:bg-red-200
                                font-bold
                                rounded-xl
                              "
                              v-if="!universidades.deleted_at"
                              type="button"
                              @click="eliminar"
                            >
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
      universidades: { type: Object, required: true },
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
      const form = useForm({ ...props.universidades });
      const guardar = () => {
        form.put(route("universidades.update", props.universidades.id));
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
            form.delete(route("universidades.destroy", props.universidades.id));
          }
        });
      };
      return { form, guardar, eliminar };
    },
  };
</script>