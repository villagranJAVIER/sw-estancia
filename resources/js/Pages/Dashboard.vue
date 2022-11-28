<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import JetButton from '@/Components/Button.vue';
</script>

<template>
    <app-layout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menú principal
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="
                    bg-white
                    overflow-hidden
                    shadow-xl
                    rounded-lg
                    p-6
                    border-b
                    border-gray-200
                    flex
                    flex-col
                    text-xl
                ">
                    <p class="mb-5">Tus recursos</p>
                    
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
                            "
                            :href="route('documentos.index')"
                            >
                                Documentos Estudiante
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
                            "
                            :href="route('estudiantes.index')"
                            >
                                Consultar Estudiante
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
                            "
                            :href="route('usuarios.index')"
                            >
                                Usuarios
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
                            "
                            :href="route('espacios.index')"
                            >
                                Gestion de Documentos
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
                            "
                            :href="route('universidades.index')"
                            >
                                Gestion de Universidades
                            </Link>
                        </li>
                    </ul>
                
                </div>
            </div>
        </div>
    </app-layout>
</template>
