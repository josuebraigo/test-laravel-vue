<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Deseos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="mt-10 sm:mt-0">
                                    <div class="md:grid md:grid-cols-3 md:gap-6 p-4">
                                        <div class="md:col-span-1">
                                            <div class="px-4 sm:px-0">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">Agregar deseo</h3>
                                                <p class="mt-1 text-sm text-gray-600">
                                                Agrega un nuevo deseo a tu lista de deseos
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-5 md:mt-0 md:col-span-2">
                                            <form @submit.prevent="submit">
                                                <div class="shadow overflow-hidden sm:rounded-md">
                                                    <div class="px-4 py-5 bg-white sm:p-6">
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-12">
                                                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                                                <input v-model="form.name" type="text" name="name" id="name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Nombre del deseo">
                                                            </div>

                                                            <div class="col-span-12">
                                                                <label for="description" class="block text-sm font-medium text-gray-700">
                                                                    Descripción
                                                                </label>
                                                                <div class="mt-1">
                                                                    <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Descripción del deseo" v-model="form.description"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-12">
                                                                <label class="block text-sm font-medium text-gray-700">
                                                                    Imagen
                                                                </label>
                                                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                                    <div class="space-y-1 text-center" v-if="!form.image">
                                                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                        <div class="flex text-sm text-gray-600">
                                                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                                <span>Sube una imagen</span>
                                                                                <input id="image" name="image" type="file" class="sr-only" @input="saveImg">
                                                                            </label>
                                                                            <p class="pl-1">o arrastra la imagen</p>
                                                                        </div>
                                                                        <p class="text-xs text-gray-500">
                                                                            PNG, JPG, GIF menor a 10MB
                                                                        </p>
                                                                    </div>
                                                                    <div class="space-y-1 text-center" v-else>
                                                                        <img :src="form.image">
                                                                        <button @click="deleteImg">Cambiar imagen</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Guardar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: {
            wish: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.wish.name,
                    description: this.wish.description,
                    image: this.wish.image,
                })
            }
        },
        methods: {
            submit() {
                console.log(this.form);
                this.form.put(this.route('wishes.update', this.wish.id));
                
            },
            saveImg(e) {    
                this.form.image = e.target.files[0];
            },
            deleteImg(e) {
                this.form.image = null;
            }
        }
    }
</script>
