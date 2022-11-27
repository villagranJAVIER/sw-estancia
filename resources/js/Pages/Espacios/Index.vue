<template>
    <app-layout title="Gestion de espacios">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ titulo }}
        </h2>
      </template>
      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
            <Link
                  class="
                      p-3
                      border-2
                      border-blue-500
                      text-blue-500
                      bg-blue-100
                      hover:bg-blue-200
                      font-bold
                      rounded-xl
                  "
                  :href="route(`${routeName}create`)"
              >
                  + Agregar nuevo
            </Link>
  
            <table v-if="espacios.data.length > 0" class="w-full text-left mt-10">
                <thead
                    class="border-b-2 border-gray-300 text-indigo-600"
                >
                    <tr>
                        <th class="px-6 py-3 text-left">
                            Nombre documento
                        </th>
                        <th class="px-6 py-3 text-left">
                            Nombre plantilla
                        </th>
                        <th class="px-6 py-3 text-left">
                            URL
                        </th>
                        <th class="px-6 py-3 text-left">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody v-for="item in espacios.data">
                    <tr
                        class="text-sm text-indigo-900 border-b border-gray-400"
                    >
                        <td class="px-6 py-4">
                          <Link :href="route('espacios.edit', item.id)" class="no-underline text-black hover:font-bold">
                            {{ item.nombre_documento }}
                          </Link>
                        </td>
                        
                        <td class="px-6 py-4">
                          <Link :href="route('espacios.edit', item.id)" class="no-underline text-black hover:font-bold">
                            {{ item.nombre_plantilla }}
                          </Link>
                          
                        </td>

                        <td class="px-6 py-4">
                          <a
                            target='_blank' rel="noopener noreferrer"
                            :href = "route('download', item.URL_plantilla)" 
                            class="no-underline text-black hover:font-bold">
                            Storage/app/public/Formatos/{{ item.URL_plantilla }}
                          </a>

                        </td>
                        <td class="px-6 py-4">
                          <Link
                            :href="route('espacios.edit', item.id)"
                            class="text-blue-500 hover:text-blue-600"
                          >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-player-play" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M7 4v16l13 -8z" />
                            </svg>
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

      <!-- <img src="storage/Formatos/logo.png" alt="">  -->
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
    espacios: {
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