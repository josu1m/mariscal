<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actividad') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form id="actividadForm" class="max-w-md mx-auto">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Capturar el evento submit del formulario
        document.getElementById('actividadForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar que el formulario se envíe automáticamente

            // Obtener los valores del formulario
            var nombre = document.getElementById('nombre').value;
            var fechaFin = document.getElementById('fecha_fin').value;
            var actividadId = document.getElementById('actividad_id').value;

            // Configurar los datos a enviar
            var formData = new FormData();
            formData.append('nombre', nombre);
            formData.append('fecha_fin', fechaFin);
            formData.append('actividad_id', actividadId);

            // Realizar la solicitud POST al servidor
            fetch('{{ route("actividad.store") }}', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al guardar la actividad');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Actividad guardada correctamente');
                    // Aquí puedes redirigir a otra página o realizar otras acciones después de guardar la actividad
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>
