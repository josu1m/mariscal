<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear estudiante') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1>Formulario para el estudiante</h1>

                <form method="POST" action="{{ route('estudiante.store') }}">
                    @csrf <!-- Directiva Blade para protección CSRF -->

                    <div>
                        <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" required
                            autofocus />
                    </div>

                    <div class="mt-4">
                        <x-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" required />
                    </div>

                    <div class="mt-4">
                        <x-input id="dni" class="block mt-1 w-full" type="text" name="dni" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button class="ml-4">
                            {{ __('Guardar') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
