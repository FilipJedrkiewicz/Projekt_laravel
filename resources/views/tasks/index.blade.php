<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja Lista Zadań</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal text-gray-900">
    <nav class="bg-indigo-700 p-4 shadow-lg text-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black uppercase tracking-widest">TaskMaster</h1>
            <form action="{{ route('tasks.index') }}" method="GET" class="flex text-gray-800 border-2 border-black rounded-md">
                <input 
                    type="search"
                    name="search"
                    placeholder="Podaj słowo klucz"
                    value=" {{ request('search') }}"
                    class="border-gray-300 rounded-l-md shadow-sm"
                >
                <select name="category" class="border-gray-300 shadow-sm border-1-0">
                    <option value="">Wybierz kategorię</option>
                    <option value="priority-desc">Sortuj wg: Priorytet malejąco</option>
                    <option value="priority-asc">Sortuj wg: Priorytet rosnąco</option>
                    <option value="completed" @selected(request('category') == 'completed')>Ukończone</option>
                    <option value="active" @selected(request('category') == 'active')>W Trakcie</option>
                    <option value="praca" @selected(request('category') == 'praca')>Praca</option>
                    <option value="dom" @selected(request('category') == 'dom')>Dom</option>
                    <option value="nauka" @selected(request('category') == 'nauka')>Nauka</option>
                    <option value="inne" @selected(request('category') == 'inne')>Inne</option>
                </select>
                <button type="submit" class="bg-indigo-600 px-4 py-2 text-white rounded-r-md hover:bg-indigo-700 transition">
                    Szukaj
                </button>
            </form>
            <div class="space-x-4 font-bold">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-200">Dashboard</a>
                <a href="{{ route('tasks.index') }}" class="border-b-2 border-white">Moje Zadania</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-red-300">Wyloguj</button>
                </form>
            </div>
        </div>
    </nav>
    <header class="justify-items-center bg-white border-b py-8 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end">
                  <form action="{{ route('tasks.store') }}" method="POST" class="mb-6" enctype="multipart/form-data">
                    @csrf
                    <div class="flex ">
                        <input
                            type="text"
                            name="title"
                            placeholder="Co masz do zrobienia?"
                            class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        <input
                            type="text"
                            name="author"
                            placeholder="Kto będzie wykonywał?"
                            class="flex-1 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        >
                        <input 
                            type="text"
                            name="due_date"
                            id="due_date"
                            placeholder="Podaj termin zadania" 
                            onfocus="this.type='date'"
                            onblur="if(this.value=='') this.type='text'"
                            class=" border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{old('due_date')}}"
                            required
                        >
                        <select name="category" id="category">
                            <option value="">Wybierz kategorię</option>
                            <option value="praca">Praca</option>
                            <option value="dom">Dom</option>
                            <option value="nauka">Nauka</option>
                            <option value="inne">Inne</option>
                        </select>
                        <select name="priority" id="priority">
                            <option value="choice">Wybierz priorytet</option>
                            <option class="text-green-500" value="low">Niski</option>
                            <option class="text-orange-500" value="medium">Średni</option>
                            <option class="text-red-500" value="high">Wysoki</option>
                        </select>
                        <input type="file" name="instruction" accept=".txt" class="text-sm">
                        <button
                            type="submit"
                            class="bg-indigo-600 px-4 py-2 text-white rounded-r-md hover:bg-indigo-700 transition">
                            Dodaj
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <main class="py-2">
        <div class="max-w-full mx-auto px-2 sm:px-2 lg:px-2">
            <div class="py-2">
                <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="grid grid-cols-9 items-center border-b pb-2 mb-2 px-2">
                            <h2 class="text-xl font-bold text-gray-800">Tytuł:</h2>
                            <h2 class="text-xl font-bold text-gray-800">Instrukcja:</h2>
                            <h2 class="text-xl font-bold text-gray-800">Termin:</h2>
                            <h2 class="text-xl font-bold text-gray-800">Utworzono:</h2>
                            <h2 class="text-xl font-bold text-gray-800">Status:</h2>
                            <h2 class="text-xl font-bold text-gray-800">Wykonawca:</h2>
                            <h2 class="text-xl font-bold text-gray-800">Kategoria:</h2>
                            <h2 class="text-xl font-bold text-gray-800">Priorytet:</h2>
                            <h2 class="flex justify-end text-xl font-bold text-gray-800">Akcje:</h2>
                        </div>
                        @foreach ($tasks as $task)
                        <div class="justify-between pb-2 mb-2 grid grid-cols-9 items-center border-b py-3 px-2 gap-5 ">
                            <div>
                                <p class="text-lg text-gray-800">{{ $task->title }}</p>
                            </div>
                            <div>
                                <a href="{{ route('tasks.instruction', $task) }}" class="text-indigo-600 hover:underline font-bold">Instrukcja</a>
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
                                        class="rounded border-gray-300 indigo-600 shadow-sm focus:ring-indigo-500 gap-1"
                                    >
                                </form>
                                @if($task->is_completed)
                                    <span class="text-green-600 font-bold">Ukończone</span>
                                @elseif($task->due_date && \Carbon\Carbon::parse($task->due_date)->isPast())
                                    <span class="text-red-600 font-bold">Nieukończone</span>
                                @else 
                                    <span class="text-blue-600 font-bold">W Trakcie</span>
                                @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-lg text-gray-800" >{{ $task->author ?? 'Brak' }}</p>
                            </div>
                            <div>
                                <p class="text-lg text-gray-800"> {{ $task->category ?? 'Brak'}}</p>
                            </div>
                            <div>
                                @if($task->priority == 'low')
                                    <span class="text-green-500 font-bold">Niski</span>
                                @elseif($task->priority == 'medium')
                                    <span class="text-orange-500 font-bold">Średni</span>
                                @elseif($task->priority == 'high')
                                    <span class="text-red-500 font-bold">Wysoki</span>
                                @endif
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
                          <div class="my-6">
                              {{ $tasks->links() }} 
                            </div>
                        <div class="flex justify-end">
                            <form action="{{ route('tasks.reset') }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć wszystkie zadania?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-700 text-white text-lg py-2 px-4 rounded transition" type="submit">
                                    Resetuj dane
                                </button>
                            </form>
                        </div>
                        @if($tasks->isEmpty())
                            <p class="text-gray-500">Brak zadań do wyświetlenia. Dodaj coś!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>



