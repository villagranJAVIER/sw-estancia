<template>
  <app-layout title="Consulta de estudiantes">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ titulo }}
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-left flex justify-start">
        <div class="w-72 ml-2">
          <input type="text" class="
                  mr-2 leading-tight
                  " placeholder="Ingrese un parámetro de búsqueda" v-model="filters.search" @change="search" />
          <div class="">
            <button @click="search" class="btn">
            </button>
          </div>
        </div>
        <select @change="search" class="
        block appearance-none w-auto bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state
                " v-model="filters.status">
          <option :value="true">Activos</option>
          <option :value="false">Eliminados</option>
        </select>
      </div>

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

import { computed, onMounted, reactive, toRefs, watch } from "vue";
import RecordsHelper from "@/Shared/RecordsHelper.vue";
import Pagination from "@/Shared/Pagination.vue";


export default {
  name: "Index",
  props: {
    titulo: { type: String, required: true },
    usuarios: {
      type: Object,
      default: {},
      required: true,
    },
    routeName: { type: String, required: true },

    loadingResults: { type: Boolean, required: true, default: true },
    search: { type: String, required: true },
    status: { type: Boolean, required: true, default: true },
  },
  components: {
    AppLayout,
    Link,
    Input,
    JetButton,
    RecordsHelper,
    Pagination,
  },
  setup(props) {
    const thereAreResults = computed(() => props.usuarios.total > 0);
    const state = reactive({
      filters: {
        page: props.usuarios.current_page,
        search: props.search,
        status: props.status ?? 1,
      },
    });
    const search = () => {
      props.loadingResults = true;
      Inertia.replace(route(`${props.routeName}index`, state.filters));
    };

    return {
      ...toRefs(state),
      search,
      thereAreResults,
    };
  },
};
</script>