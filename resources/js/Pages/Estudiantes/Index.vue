<template>
  <app-layout title="Consulta de estudiantes">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ titulo }}
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">

        <table v-if="usuarios.data.length > 0" class="w-full text-left mt-10">
          <thead class="border-b-2 border-gray-300 text-indigo-600">
            <tr>
              <th class="px-6 py-3 text-left">
                Nombre
              </th>
              <th class="px-6 py-3 text-left">
                Apellidos
              </th>
              <th class="px-6 py-3 text-left">
                Universidad
              </th>
              <th class="px-6 py-3 text-left">
                Correo electronico
              </th>
              <th class="px-6 py-3 text-left">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody v-for="item in usuarios.data">
            <tr v-if="item.tipo == 4" class="text-sm text-indigo-900 border-b border-gray-400">
              <td class="px-6 py-4">
                <Link :href="route('estudiantes.show', item.id)" class="no-underline text-black hover:font-bold">
                {{ item.name }}
                </Link>
              </td>
              <td class="px-6 py-4">
                <Link :href="route('estudiantes.show', item.id)" class="no-underline text-black hover:font-bold">
                {{ item.apellidoP }} {{ item.apellidoM }}
                </Link>
              </td>

              <td class="px-6 py-4">
                <Link :href="route('estudiantes.show', item.id)" class="no-underline text-black hover:font-bold">
                {{ item.id_universidad }}
                </Link>
              </td>
              <td class="px-6 py-4">
                <Link :href="route('estudiantes.show', item.id)" class="no-underline text-black hover:font-bold">
                {{ item.email }}
                </Link>
              </td>
              <td class="px-6 py-4">
                <Link class="
                              p-1.5
                              border-2
                              border-blue-500
                              text-blue-500
                              bg-blue-100
                              hover:bg-blue-200
                              font-bold
                              rounded-xl
                              mr-3
                          " :href="route('estudiantes.show', item.id)">
                  Consultar
                </Link>

              </td>
            </tr>
          </tbody>
        </table>
        <div v-else class="bg-red-100 border border-red-400 p-3 rounded-lg text-red-800 mt-5 text-left">
          No hay ningun registro
        </div>
      </div>
    </div>

  </app-layout>
</template>
  
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3"
import Input from "@/Components/Input.vue";
import JetButton from '@/Components/Button.vue';

export default {
  name: "Index",
  props: {
    titulo: { type: String, required: true },
    usuarios: {
      type: Object,
      default: {},
      required: true,
    },
    routeName: { type: String, required: true }
  },
  components: {
    AppLayout,
    Link,
    Input,
    JetButton,
  },
};
</script>