<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actividad') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form id="actividadForm" class="max-w-md mx-auto" method="POST" action="{{ route('actividad.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la
                            actividad:</label>
                        <input type="text" name="nombre" id="nombre"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de finalización
                            (opcional):</label>
                        <input type="datetime-local" name="fecha_fin" id="fecha_fin"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <input type="hidden" name="actividad_id" id="actividad_id" value="">
                    <button type="submit" name="guardar"
                        class="w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition duration-150 ease-in-out">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
