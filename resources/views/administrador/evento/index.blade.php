<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'miModal')"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">{{ __('Abrir modal') }}
                </button>
            </div>
        </div>
    </div>
    <x-modal name="miModal">
        <form action="{{ route('evento.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" id="titulo"
                    class="mt-1 p-2 w-full border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Ingrese el título del evento" required>
            </div>
            <div class="mb-4 relative">
                <span class="block text-sm font-medium text-gray-700 mb-1">Imagen (Opcional)</span>
                <input type="file" name="imagen" id="imagen" accept="image/*"
                    class="absolute inset-0 z-50 w-full h-full opacity-0 cursor-pointer">
                <div class="mt-1 relative">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
                            </rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <span class="ml-2">Seleccionar imagen</span>
                    </button>
                </div>
            </div>


            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-green-700 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Crear Evento
                </button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
