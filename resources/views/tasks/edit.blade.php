<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edytuj Zadanie') }}
        </h2>
    </x-slot>
    <div class="bg-white shadow p-6"> 
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 items-center border-b pb-2 mb-2 px-2 gap-2">
                <p class="text-xl font-bold text-gray-800">Tytuł:</p>
                <input 
                    type="text"
                    name="title"
                    value="{{ $task->title }}"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >

                <p class="text-xl font-bold text-gray-800">Wykonawca:</p>
                <input 
                    type="text"
                    name="author"
                    value="{{ $task->author }}"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >

                <p class="text-xl font-bold text-gray-800">Termin:</p>
                <input 
                    type="date"
                    name="due_date"
                    value="{{ $task->due_date }}"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                <p class="text-xl font-bold text-gray-800">Kategoria:</p>
                <select name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="Praca" @selected($task->category == 'Praca')>
                        Praca
                    </option>
                    <option value="Dom" @selected($task->category == 'Dom')>
                        Dom
                    </option>
                    <option value="Nauka" @selected($task->category == 'Nauka')>
                        Nauka
                    </option>
                    <option value="Inne" @selected($task->category == 'Inne')>
                        Inne
                    </option>
                </select>
                <p class="text-xl font-bold text-gray-800">Priorytet:</p>
                <select name="priority" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option class="text-green-500 font-bold" value="low" @selected($task->priority == 'low')>
                        Niski
                    </option>
                    <option class="text-orange-500 font-bold" value="medium" @selected($task->priority == 'medium')>
                        Średni
                    </option>
                    <option class="text-red-500 font-bold" value="high" @selected($task->priority == 'high')>
                        Wysoki
                    </option>
                </select>
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 px-4 py-2 text-white rounded-md hover:bg-indigo-700 transition">
                        Zapisz zmiany
                    </button>
                </div>
            </div>
        </form>
    </div>    
</x-app-layout>