<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Pago') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1>Formulario para el Pago</h1>

                <form id="pagoForm" method="POST" action="{{ route('pago.store') }}">
                    @csrf <!-- Directiva Blade para protección CSRF -->

                    <div class="mt-4">
                        <select name="actividad_id" id="actividad_id" class="block w-full" required>
                            <option value="">Seleccionar título</option>
                            @foreach ($actividads as $actividad)
                                <option value="{{ $actividad->id }}">{{ $actividad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <select name="estudiante_id[]" id="estudiante_id" multiple class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                            @if ($estudiantes->count() > 1)
                                <option value="seleccionar_todos" id="seleccionar_todos">Seleccionar Todos los Estudiantes</option>
                            @endif
                            @foreach ($estudiantes as $estudiante)
                                <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <x-input id="monto" class="block mt-1 w-full" type="number" name="monto" step="any" required />
                    </div>
                    

                    <div class="mt-4">
                        <textarea id="descripcion" name="descripcion" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required></textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="ml-4 bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Guardar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pagoForm = document.getElementById('pagoForm');
        const actividadSelect = document.getElementById('actividad_id');

        pagoForm.addEventListener('submit', function(event) {
            if (!actividadSelect.value) {
                event.preventDefault();
                alert('Por favor, seleccione una actividad.');
            }
        });

        // Obtener el select de estudiantes
        const selectEstudiantes = document.querySelector('#estudiante_id');
        // Obtener la opción "Seleccionar Todos los Estudiantes"
        const seleccionarTodosOption = document.querySelector('#seleccionar_todos');

        // Si solo hay una opción (la de "Seleccionar Todos los Estudiantes"), deshabilitarla
        if (selectEstudiantes.length === 1) {
            seleccionarTodosOption.disabled = true;
        }

        // Escuchar el evento de cambio del select de estudiantes
        selectEstudiantes.addEventListener('change', function() {
            // Habilitar o deshabilitar la opción "Seleccionar Todos los Estudiantes" según el número de estudiantes seleccionados
            if (selectEstudiantes.selectedOptions.length === 1 && selectEstudiantes.value ===
                'seleccionar_todos') {
                seleccionarTodosOption.disabled = true;
            } else {
                seleccionarTodosOption.disabled = false;
            }
        });

        // Escuchar el evento 'change' en el select de estudiantes
        selectEstudiantes.addEventListener('change', function() {
            // Verificar si la opción "Seleccionar Todos los Estudiantes" está seleccionada
            if (seleccionarTodosOption.selected) {
                // Recorrer todas las opciones y seleccionarlas
                for (let i = 0; i < selectEstudiantes.options.length; i++) {
                    selectEstudiantes.options[i].selected = true;
                }
            }
        });
    });
</script>
