<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moje Zadania') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('tasks.store') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="flex">
                        <input
                            type="text"
                            name="title"
                            placeholder="Co masz do zrobienia?"
                            class="flex-1 rounded-l-md border-gray-300 shadow-sm focus::border-indigo-500 focus::ring-indigo-500"
                            required
                        >
                        <button
                            type="submit"
                            class="bg-indigo-600 px-4 py-2 text-white rounded-r-md hover:bg-indigo-700 transition"
                        >
                            Dodaj
                        </button>
                    </div>

                </form>
              @foreach ($tasks as $task)
    <div class="flex items-center justify-between border-b pb-2 mb-2">
        {{-- Tytuł zadania --}}
        <p class="text-lg text-gray-800">{{ $task->title }}</p>

        {{-- Formularz usuwania --}}
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-xs font-bold py-1 px-3 rounded transition">
                Usuń
            </button>
        </form>
    </div>
@endforeach

                @if($tasks->isEmpty())
                    <p class="text-gray-500">Brak zadań do wyświetlenia. Dodaj coś!</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
