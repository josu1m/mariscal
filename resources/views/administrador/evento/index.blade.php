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
        <!-- Contenido del modal aquí -->
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem repellat amet rerum. Saepe sint magnam
            id. Exercitationem, ea minus maxime id, nisi architecto, magni dolore suscipit tenetur voluptatum mollitia
            reiciendis?</p>
    </x-modal>
</x-app-layout>
