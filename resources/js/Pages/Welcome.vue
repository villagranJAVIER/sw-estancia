<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Components/ApplicationMark.vue'
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="
        grid
        grid-cols-2
        text-center
        py-10
        px-72
        bg-blue-700
        text-white
         dark:bg-gray-900
    ">
        <div>
            <JetApplicationMark class="h-12 w-auto"></JetApplicationMark>
        </div>
        <div v-if="canLogin">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm underline hover:text-gray-400">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-base underline hover:text-gray-400">
                    Iniciar Sesión
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="text-base underline place-self-end ml-4 hover:text-gray-400">
                    Registrarse
                </Link>
            </template>
        </div>
    </div>

</template>
