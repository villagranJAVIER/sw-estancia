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
                    <form class="flex flex-col items-center p-16" @submit.prevent="guardar"
                        enctype="multipart/form-data">

                        <jet-label for="campo1" value="Nombre Documento:" />
                        <jet-input id="campo1" class="px-5 py-3 w-96 border border-gray-600 rounded"
                            v-model="form.nombre_documento" :class="{ 'is-invalid': form.errors.nombre_documento }"
                            required placeholder="Nombre documento" />
                        <jet-input-error :message="form.errors.nombre_documento" />

                        <jet-label for="campo2" value="Nombre plantilla(Opcional):" class="mt-7" />
                        <jet-input id="campo2" class="px-5 py-3 w-96 border border-gray-600 rounded"
                            v-model="form.nombre_plantilla" :class="{ 'is-invalid': form.errors.nombre_plantilla }"
                            placeholder="Nombre plantilla" />
                        <jet-input-error :message="form.errors.nombre_plantilla" />

                        <div class="w-96 mt-7 text-center">
                            <jet-label for="campo4" value="Selecciona un archivo de la plantilla:" />
                            <jet-input
                                class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                type="file" @input="form.URL_plantilla = $event.target.files[0]" />
                        </div>

                        <div class="flex items-center justify-between mt-14 w-96">
                            <Link :href="route(`${routeName}index`)"
                                class="underline text-sm text-gray-600 hover:text-gray-900">
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
        const form = useForm({ nombre_documento: "", nombre_plantilla: "", URL_plantilla: "" });

        const guardar = () => {
            if(form.nombre_plantilla=="" || form.URL_plantilla==""){form.nombre_plantilla="Vacio";form.URL_plantilla="Vacio";}
            form.post(route("espacios.store"));
        };
        return { form, guardar };
    },
};
</script>