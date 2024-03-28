<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagos') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-100">
                <x-nav-link :href="route('pago.create')" :active="request()->routeIs('pago.index')">
                    {{ __('Pagos') }}
                </x-nav-link>
                <x-nav-link :href="route('actividad.index')" :active="request()->routeIs('actividad.index')">
                    {{ __('Crear titulo de la actividad') }}
                </x-nav-link>

                <h3 class="mb-4">Listado de Pagos</h3>
                @foreach ($pagos->groupBy('actividad.nombre') as $actividad => $pagosActividad)
                    <div class="flex flex-row">
                        <h4 class="py-2 mx-4">{{ $actividad }}</h4>
                        <input type="text" id="search" placeholder="Buscar por nombre, apellidos y DNI..."
                            class="flex-grow block mb-4 p-2 border border-gray-300 rounded text-teal-950">
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Estudiante</th>
                                    <th class="px-4 py-2">Monto</th>
                                    <th class="px-4 py-2">DNI</th>
                                    <th class="px-4 py-2">Estado del pago</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($pagosActividad as $pago)
                                    <tr>
                                        <td class="border px-4 py-2"
                                            data-student="{{ strtolower($pago->estudiante->nombre) }} {{ strtolower($pago->estudiante->apellido) }}">
                                            {{ $pago->estudiante->nombre }} {{ $pago->estudiante->apellido }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $pago->monto }}</td>
                                        <td class="border px-4 py-2"
                                            data-student="{{ strtolower($pago->estudiante->dni) }}">
                                            {{ $pago->estudiante->dni }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <form method="POST" action="{{ route('pago.update', $pago->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="pagado" onchange="this.form.submit()"
                                                    class="block appearance-none w-full bg-teal-400 border-0 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:border-gray-500">
                                                    <option value="0" {{ $pago->pagado == 0 ? 'selected' : '' }}>
                                                        Pendiente</option>
                                                    <option value="1" {{ $pago->pagado == 1 ? 'selected' : '' }}>
                                                        Pagado
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('pago.edit', $pago->id) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Editar
                                            </a>
                                            <button>Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#table-body tr');

            rows.forEach(row => {
                const studentData = row.textContent.toLowerCase();

                if (studentData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

</x-app-layout>
