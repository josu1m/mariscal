<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mx-4">
                {{ __('Pagos') }}
            </h2>
            <form method="GET" action="{{ route('pago.index') }}" class="flex-grow">
                <input type="text" name="search" placeholder="Buscar por nombre, apellidos y DNI..."
                    value="{{ request()->query('search') }}"
                    class="block mb-4 p-2 border border-gray-300 rounded text-teal-950 w-full">
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded mr-1">
                    Buscar
                </button>
                <a href="{{ route('pago.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                    Limpiar
                </a>
            </form>
        </div>
    </x-slot>

    <div class="relative w-full h-screen  flex-row">

        <div class="top-0 left-0 right-0 flex justify-between px-0">
            <button id="prevBtn"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-1 rounded">
                <i class='bx bx-chevron-left'></i>
            </button>
            <x-nav-link :href="route('pago.create')" :active="request()->routeIs('pago.index')">
                {{ __('Pagos') }}
            </x-nav-link>
            <x-nav-link :href="route('actividad.index')" :active="request()->routeIs('actividad.index')">
                {{ __('Crear título de la actividad') }}
            </x-nav-link>
            <button id="nextBtn"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-1 rounded">
                <i class='bx bx-chevron-right'></i>
            </button>
        </div>
        
        <div class="overflow-hidden w-full">
            <div class="flex relative flex-wrap overflow-x-auto">
                @php $slideCount = 1; @endphp
                @foreach ($pagosPorActividad as $nombreActividad => $pagos)
                    <div class="w-full lg:w-full flex-none lg:flex-1 @if ($slideCount > 1) hidden @endif">
                        <div class="h-full w-full flex justify-center bg-gray-200">
                            <div class="text-center w-full">
                                <h2 style="font-size: 24px; color: #333; margin-top: 20px;">{{ $nombreActividad }}</h2>
                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full min-w-max divide-y divide-gray-200">
                                        <thead class="bg-gray-50" >
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actividad
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estudiante
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado del pago
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($pagos as $pago)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $pago->actividad->nombre }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $pago->estudiante->nombre }} {{ $pago->estudiante->apellido }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $pago->monto }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $pago->estudiante->dni }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form method="POST" action="{{ route('pago.update', $pago->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="pagado" onchange="this.form.submit()"
                                                            class="block w-full bg-teal-100 border border-teal-300 rounded-md py-1 px-3">
                                                            <option value="0" {{ $pago->pagado == 0 ? 'selected' : '' }}>Pendiente</option>
                                                            <option value="1" {{ $pago->pagado == 1 ? 'selected' : '' }}>Pagado</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ route('pago.edit', $pago->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                    @php $slideCount++; @endphp
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const carousels = document.querySelectorAll('.flex-none');

    let currentIndex = 0;

    function showCarousel(index) {
        carousels.forEach((carousel, i) => {
            if (i === index) {
                carousel.classList.remove('hidden');
            } else {
                carousel.classList.add('hidden');
            }
        });
    }

    prevBtn.addEventListener('click', () => {
        currentIndex = currentIndex === 0 ? carousels.length - 1 : currentIndex - 1;
        showCarousel(currentIndex);
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % carousels.length;
        showCarousel(currentIndex);
    });
</script>
