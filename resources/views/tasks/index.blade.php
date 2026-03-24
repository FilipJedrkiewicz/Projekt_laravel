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
                            class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        <input 
                            type="date"
                            name="due_date"
                            id="due_date"
                            placeholder="Podaj termin zadania" 
                            class=" border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{old('due_date')}}"
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
                <div class="grid grid-cols-5 items-center border-b pb-2 mb-2 px-2">
                    <h2 class="text-xl font-bold text-gray-800">Tytuł:</h2>
                    <h2 class="text-xl font-bold text-gray-800">Termin:</h2>
                    <h2 class="text-xl font-bold text-gray-800">Utworzono:</h2>
                    <h2 class="text-xl font-bold text-gray-800">Status:</h2>
                    <h2 class="flex justify-end text-xl font-bold text-gray-800">Akcje:</h2>
                </div>
        @foreach ($tasks as $task)
        <div class="justify-between pb-2 mb-2 grid grid-cols-5 items-center border-b py-3 px-2 ">
            <div>
                <p class="text-lg text-gray-800">{{ $task->title }}</p>
            </div>

            <div>
                <p class="text-lg text-gray-800">{{ $task->due_date }}</p>
            </div>

            <div>
                <p class="text-lg text-gray-800">{{ $task->created_at->format('d.m.Y.H:i') }}</p>
            </div>
                 
            <div>
               
                <div class="flex items-center gap-2">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input 
                        type="checkbox"
                        name="is_completed"
                        onchange="this.form.submit()"
                        {{ $task->is_completed ? 'checked' : '' }}
                        class="rounded border-gray-300 text indigo-600 shadow-sm focus:ring-indigo-500 "
                    >
                </form>

                @if($task->is_completed)
                    <span class="text-green-600 font-bold">Ukończone</span>
                @elseif($task->due_date && \Carbon\Carbon::parse($task->due_date)->isPast())
                    <span class="text-red-600 font-bold">Nieukończone (Termin minął)</span>
                @else 
                    <span class="text-blue-600 font-bold">W Trakcie</span>
                @endif
                </div>
            </div>
          
            
            <div class="flex flex-col items-end gap-1">
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-xs font-bold py-1 px-3 rounded transition ">
                        Usuń
                    </button>
                </form>
                <a href="{{route('tasks.edit', $task) }}" class="bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-1 px-3 rounded transition ">
                    Edytuj
                </a>
            </div>
           
            
        </div>
        @endforeach

                @if($tasks->isEmpty())
                    <p class="text-gray-500">Brak zadań do wyświetlenia. Dodaj coś!</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
