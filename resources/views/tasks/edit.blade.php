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
            <div class="grid grid-cols-2 items-center border-b pb-2 mb-2 px-2">
                <p class="text-xl font-bold text-gray-800">Tytuł</p>
                <input type="text">
                <p class="text-xl font-bold text-gray-800">Termin</p>
            </div>
        </form>
    </div>
    
</x-app-layout>