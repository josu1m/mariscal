<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <x-nav-link :href="route('estudiante.create')" :active="request()->routeIs('create.index')">
                    {{ __('Estudiante') }}
                </x-nav-link>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Apellido
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                DNI
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado de Pago
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad de deuda </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($estudiantes as $estudiante)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $estudiante->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $estudiante->nombre }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $estudiante->apellido }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $estudiante->dni }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $tienePendiente = false; // Variable para verificar si el estudiante tiene al menos un pago pendiente
                                    @endphp

                                    @foreach ($estudiante->pagos as $pago)
                                        @if (!$pago->pagado)
                                            @php
                                                $tienePendiente = true; // Establecer la variable a true si se encuentra al menos un pago pendiente
                                                break; // Salir del bucle una vez que se encuentre un pago pendiente
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if ($tienePendiente)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Pendiente
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Pagado
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $pendientesCount = 0; // Variable para almacenar la cantidad de pagos pendientes
                                    @endphp

                                    @foreach ($estudiante->pagos as $pago)
                                        @if (!$pago->pagado)
                                            @php
                                                $pendientesCount++; // Incrementar el contador de pagos pendientes
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if ($pendientesCount > 0)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $pendientesCount }}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            0 </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
