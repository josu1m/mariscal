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

                @if ($eventos->isEmpty())
                    <p class="text-gray-700">No hay eventos disponibles.</p>
                @else
                    <table class="min-w-full divide-y bg-white rounded-lg overflow-hidden">
                        <thead class="bg-gray-500">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Título
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Imagen
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($eventos as $index => $evento)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-gray-300' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $evento->titulo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($evento->imagen)
                                            <img src="{{ asset($evento->imagen) }}" alt="Imagen del evento"
                                                class="h-10 w-10 rounded-full">
                                        @else
                                            No hay imagen
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('evento.destroy', $evento->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="document.getElementById('confirmModal').classList.remove('hidden'); document.getElementById('confirmModal').removeAttribute('aria-hidden', 'true');"
                                                class="bg-red-500 text-white hover:bg-red-700 hover:text-white font-semibold py-2 px-4 rounded" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirmModal')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <!--para eliminar-->
    @foreach ($eventos as $evento)

        <x-dialog-modal id="confirmModal" name="confirmModal">

            <x-slot name="header">
                Confirmación
            </x-slot>

            <x-slot name="headerContent">
                <p class="text-sm text-gray-500">
                    ¿Estás seguro de que deseas eliminar este evento?
                </p>
            </x-slot>

            <form id="deleteForm" action="{{ route('evento.destroy', $evento->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            <x-slot name="footer">
                <button type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                    onclick="document.getElementById('deleteForm').submit();">
                    Sí, eliminar
                </button>
                <button type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    onclick="document.getElementById('confirmModal').classList.add('hidden'); document.getElementById('confirmModal').setAttribute('aria-hidden', 'true');" x-on:click="$dispatch('close')">
                    Cancelar
                </button>
            </x-slot>

        </x-dialog-modal>
    @endforeach

    <!--para agregar-->
    <x-modal name="miModal">
        <form id="eventoForm" action="{{ route('evento.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 bg-white rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="titulo" id="titulo"
                    class="mt-1 p-2 w-full border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Ingrese el título del evento" required>
                <p id="tituloError" class="text-red-500 text-sm mt-1"></p>
            </div>

            <div class="mb-4">
                <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen (Opcional)</label>
                <input type="file" name="imagen" id="imagen" accept="image/*"
                    class="mt-1 p-2 w-full border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <p id="imagenError" class="text-red-500 text-sm mt-1"></p>
            </div>

            <div class="flex justify-end">
                <button type="button" id="submitBtn" class="ms-3">
                    {{ __('Crear evento') }}
                </button>
            </div>
        </form>
    </x-modal>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('submitBtn').addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir el envío del formulario

                // Limpiar los mensajes de error anteriores
                document.querySelectorAll('.text-red-500').forEach(function(element) {
                    element.textContent = '';
                });

                // Verificar si el campo de título está vacío
                if (!document.getElementById('titulo').value.trim()) {
                    document.getElementById('tituloError').textContent =
                        'Por favor, ingrese el título del evento.';
                    setTimeout(function() {
                        document.getElementById('tituloError').textContent = '';
                    }, 5000); // Ocultar el mensaje después de 5 segundos
                    return;
                }

                // Verificar si se ha seleccionado un archivo de imagen
                var imagenInput = document.getElementById('imagen');
                if (!imagenInput.files.length || !imagenInput.files[0].type.match('image.*')) {
                    document.getElementById('imagenError').textContent =
                        'La imagen es requerida y debe ser de tipo imagen.';
                    setTimeout(function() {
                        document.getElementById('imagenError').textContent = '';
                    }, 5000); // Ocultar el mensaje después de 5 segundos
                    return;
                }

                // Si todo está bien, enviar el formulario
                document.getElementById('eventoForm').submit();

                // Opcional: Puedes cerrar el modal aquí si el envío del formulario es exitoso
                // document.querySelector('[name="miModal"]').dispatchEvent(new CustomEvent('close-modal'));
            });
        });
    </script>

</x-app-layout>
