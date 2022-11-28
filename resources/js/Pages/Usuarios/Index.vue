<template>
    <app-layout title="Gestion usuarios">
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
  
            <table v-if="usuarios.data.length > 0" class="w-full text-left mt-10">
                <thead
                    class="border-b-2 border-gray-300 text-indigo-600"
                >
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
                            Tipo
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
                    <tr
                        class="text-sm text-indigo-900 border-b border-gray-400"
                    >
                        <td class="px-6 py-4">
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold">
                            {{ item.name }}
                          </Link>
                        </td>
                        <td class="px-6 py-4">
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold">
                            {{ item.apellidoP }} {{item.apellidoM}}
                          </Link>
                        </td>

                        <td class="px-6 py-4">
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold">
                            {{ item.id_universidad }}
                          </Link>
                        </td>
                        <td class="px-6 py-4">
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold" v-if="item.tipo==1">
                            Administrador
                          </Link>
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold" v-if="item.tipo==2">
                            Asistente
                          </Link>
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold" v-if="item.tipo==3">
                            Maestro
                          </Link>
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold" v-if="item.tipo==4">
                            Estudiante
                          </Link>
                        </td>
                        <td class="px-6 py-4">
                          <Link :href="route('usuarios.edit', item.id)" class="no-underline text-black hover:font-bold">
                            {{ item.email }}
                          </Link>
                        </td>
                        <td class="px-6 py-4">
                          <Link
                            :href="route('usuarios.edit', item.id)"
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