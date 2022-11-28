<template>
    <app-layout title="Consulta de estudiante">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ titulo }} - {{ estudiantes.name }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
                <div class="bg-slate-200 p-10 border-2 border-blue-300 rounded-xl mb-16">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left mb-12">
                        Datos del estudiante
                    </h2>
                    <table class="w-full text-left mt-10">
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-sm text-indigo-900 border-b border-gray-400">
                                <td class="px-6 py-4">
                                    {{ estudiantes.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ estudiantes.apellidoP }} {{ estudiantes.apellidoM }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ uni.nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ estudiantes.email }}
                                </td>
                                <td class="px-6 py-4">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-slate-200 p-10 border-2 border-blue-300 rounded-xl mb-16">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left">
                        Documentación
                    </h2>
                    <table v-if="doc.data.length > 0" class="w-full text-left mt-10">
                        <thead class="border-b-2 border-gray-300 text-indigo-600">
                            <tr>
                                <th class="px-6 py-3 text-left">
                                    Documento
                                </th>
                                <th class="px-6 py-3 text-left">
                                    URL
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Estatus
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Comentarios
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in doc.data" :key="item.id"
                                class="text-sm text-indigo-900 border-b border-gray-400">
                                <td class="px-6 py-4">
                                    {{ item.nombre_documento }}
                                </td>
                                <td class="px-6 py-4">
                                    <a target='_blank' rel="noopener noreferrer"
                                        :href="route('downloadDoc', item.URL_documento)"
                                        class="no-underline text-black hover:font-bold flex items-center">
                                        {{ item.URL_documento }}
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-text" width="44" height="44"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <line x1="9" y1="9" x2="10" y2="9" />
                                            <line x1="9" y1="13" x2="15" y2="13" />
                                            <line x1="9" y1="17" x2="15" y2="17" />
                                        </svg>
                                    </a>
                                </td>

                                <td class="px-6 py-4">
                                    {{ item.estatus }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.comentarios }}
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
                                    " :href="route('estudiantes.edit', item.id)">
                                    Validar
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="bg-red-100 border border-red-400 p-3 rounded-lg text-red-800 mt-5 text-left">
                        No hay ningun registro
                    </div>
                </div>

                <div class="bg-slate-200 p-10 border-2 border-blue-300 rounded-xl mb-16 text-left">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left mb-12">
                        Asignación
                    </h2>
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
                        " :href="route('asignaciones.show', estudiantes.id)"
                        v-if="asig.data.length == 0"
                        >
                    Asignar maestro
                    </Link>
                    <table class="w-full text-left mt-10">
                        <thead class="border-b-2 border-gray-300 text-indigo-600">
                            <tr>
                                <th class="px-6 py-3 text-left">
                                    Estudiante
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Maestro
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Acciones
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in asig.data" :key="item.id"
                                class="text-sm text-indigo-900 border-b border-gray-400">
                                <td class="px-6 py-4">
                                    <Link :href="route('asignaciones.edit', item.id)"
                                        class="no-underline text-black hover:font-bold">
                                    {{ estudiantes.name }}
                                    </Link>
                                </td>
                                <td class="px-6 py-4">
                                    <Link :href="route('asignaciones.edit', item.id)"
                                        class="no-underline text-black hover:font-bold">
                                    {{ item.id_maestro }}
                                    </Link>
                                </td>
                                <td>
                                    <Link :href="route('asignaciones.edit', item.id)"
                                        class="text-blue-500 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-player-play" width="44" height="44"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 4v16l13 -8z" />
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-slate-200 p-10 border-2 border-blue-300 rounded-xl mb-16">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left">
                        Recursos
                    </h2>
                    <ul class="p-3">
                        <li class="ml-2 flex flex-row items-center">
                            <div class="bg-gray-500 mr-3 h-2 w-2"></div>
                            <Link class="
                                hover:text-gray-800
                                mt-2
                                text-sm
                                text-indigo-500
                                border-b
                                border-gray-400
                            " :href="route('subirDoc', estudiantes.id)">
                            Carta aceptación
                            </Link>
                        </li>

                        <li class="ml-2 flex flex-row items-center">
                            <div class="bg-gray-500 mr-3 h-2 w-2"></div>
                            <Link class="
                                hover:text-gray-800
                                mt-2
                                text-sm
                                text-indigo-500
                                border-b
                                border-gray-400
                            " :href="route('subirDoc', estudiantes.id)">
                            Carta liberación
                            </Link>
                        </li>

                    </ul>
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
        estudiantes: {
            type: Object,
            default: {},
            required: true,
        },
        uni: {
            type: Object,
            default: {},
            required: true,
        },
        doc: {
            type: Object,
            default: {},
            required: true,
        },
        asig: {
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