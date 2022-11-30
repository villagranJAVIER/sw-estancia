<style>
.input-search {
    width: 100%;
}
@media only screen and (min-width: 768px) { 
    .input-search {
        width: 100%;
    }
}
</style>

<template>
    <div class="form ml-0 ml-md-3 mt-3 mt-md-0 input-search">
        <form @submit.prevent="search">
            <div class="input-group input-group-sm">
                <input
                    type="text"
                    class="form-control form-control-navbar"
                    placeholder="Búsqueda de Empleado"
                    v-model="text"
                />
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit" v-show="showSearchButton">
                        <i class="bi bi-search"/>&nbsp;Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <JetDialogModal id="search-employee" maxWidth="lg" :showCloseButton="false">
        <template #title>
            <i class="bi bi-people"></i>&nbsp;Empleados
            <span class="text-muted text-sm">Resultados de la búsqueda</span>
        </template>
        <template #content>
            <form @submit.prevent="search">
                <div class="input-group input-group-sm mb-3">
                    <input
                        autofocus
                        ref         = "searchInputModal"
                        id          = "searchInputModal"
                        type        = "text"
                        class       = "form-control form-control-sm border-0 shadow-sm"
                        placeholder = "búsqueda de empleados"
                        v-model     = "text"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-navbar shadow-sm" type="submit" v-show="showSearchButton">
                            <i class="bi bi-search"/>&nbsp;Buscar
                        </button>
                    </div>
                </div>
            </form>
            <div class="table-responsive" v-if="thereAreResults">
                <table class="table table-borderless table-striped table-hover table-sm text-sm">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>RFC</th>
                            <th>CURP</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item) of results.data" :key="item.id">
                            <td><inertia-link v-html="item.full_name" @click="closeModal" :href="route('empleados.show', item.id)" class="d-flex text-decoration-none text-reset"/></td>
                            <td><inertia-link v-html="item.rfc"  @click="closeModal" :href="route('empleados.show', item.id)" class="d-flex text-decoration-none text-reset"/></td>
                            <td><inertia-link v-html="item.curp" @click="closeModal" :href="route('empleados.show', item.id)" class="d-flex text-decoration-none text-reset"/></td>
                            <td><inertia-link @click="closeModal" :href="route('empleados.show', item.id)" class="d-flex text-decoration-none text-reset font-weight-bold"><i class="bi bi-caret-right-fill"/></inertia-link></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <RecordsHelper
                v-if             = " ! thereAreResults || loadingResults"
                :thereAreResults = "thereAreResults"
                :loadingResults  = "loadingResults"
                :cardStyle       = "false"
            />
        </template>
        <template #footer>
            <button class="btn btn-outline-secondary btn-sm" @click="closeModal">
                <i class="bi bi-x-circle"></i>&nbsp;Cerrar
            </button>
            <inertia-link
                @click.prevent = "closeModal"
                :data  = "{search: text}"
                :href  = "route('empleados.search-for-many-results')"
                class  = "btn btn-outline-secondary btn-sm"
                v-if   = "thereAreMoreThan10Results">
                Ver más resultados
                <i class="bi bi-arrow-right-circle"></i>
            </inertia-link>
        </template>
    </JetDialogModal>
</template>
<script>
import {computed, ref} from "vue";
import JetActionSection from '@/Jetstream/ActionSection'
import JetDialogModal from '@/Jetstream/DialogModal'
import * as Bootstrap from 'bootstrap'
import RecordsHelper from "./RecordsHelper";
import Swal from "sweetalert2";

export default {
    name: "EmployeeSearch",
    components: {RecordsHelper, JetActionSection, JetDialogModal},
    setup(){
        const text = ref('');
        const results = ref([]);
        const loadingResults = ref(false);
        const modal  = ref(null);
        const search = () => {
            loadingResults.value = true;
            results.value = [];
            if(text.value.trim() !== '' && text.value.length >= 4) {
                let open = false;
                if(modal.value === null) {
                    open = true;
                    modal.value = new Bootstrap.Modal(document.getElementById('search-employee'), {backdrop:'static', keyboard:false});
                }
                axios.post(route('empleados.search'), {search: text.value}).then(response => {
                    loadingResults.value = false;
                    if (response.data.total === 1) {
                        const employee = response.data.data[0];
                        return window.location = route('empleados.show', employee.id);
                    }
                    if(open === true) {
                        modal.value.toggle();
                        setTimeout(() => {setFocusToSearchInputModal()}, 500);
                    }
                    results.value = response.data;
                }).catch(console.error);
            } else {
                loadingResults.value = false;
                Swal.fire({toast: true, title: 'Escriba al menos 5 caracteres', icon: 'info', showConfirmButton: false, timer: 6000, position: 'top-end'});
            }
        };
        const setFocusToSearchInputModal = () => document.getElementById('searchInputModal').focus();
        const thereAreResults = computed(() => results.value && results.value.total > 0);
        const thereAreMoreThan10Results = computed(() => results.value && results.value.total > 10);
        const closeModal = (() => {
            text.value = '';
            modal.value.toggle()
            modal.value = null;
        });
        const showSearchButton = computed(() => text.value.length >= 4);
        return {text, search, results, thereAreResults, thereAreMoreThan10Results, loadingResults, closeModal, showSearchButton}
    }
}
</script>
