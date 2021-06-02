<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Información del deseo
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Detalles del deseo
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nombre: 
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ wish.name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Descripción:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ wish.description }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Estatus:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span :class="wish.bought ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                            {{ wish.bought ? 'Comprado' : 'Deseo' }}
                        </span>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Imagen:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <img :src="wish.image" :alt="wish.name">
                    </dd>
                </div>
                <form @submit.prevent="submit" class="flex justify-end px-4 py-5 items-center">
                    <input type="hidden" :v-model="wish.id">
                    <inertia-link :href="route('wishes.index')" class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Regresar a la lista de deseos
                    </inertia-link>
                    <button class="ml-6 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md" v-if="!wish.bought">Comprar</button>
                    <a class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md" @click.prevent="destroy">Eliminar</a>
                </form>
            </dl>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },

    props: {
        wish: Object,
    },

    data() {
        return {
            form: {
                id: this.wish.id,
            }
        }
    },

    methods: {
        submit() {
            this.$inertia.put(this.route('wishes.buy', this.wish.id), this.form)
        },
        destroy() {
            if(confirm('¿Desea eliminar?')) {
                this.$inertia.delete(this.route('wishes.destroy', this.wish.id));
            }
        }


    }
}
</script>