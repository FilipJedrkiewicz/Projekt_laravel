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
            <h1 class="text-4xl font-black text-yellow-500 uppercase tracking-widest">Instrukcja</h1>
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
    <main class="py-2 ">
        <div class="justify-items-center max-w-7xl py-2 px-10 mx-auto border-2 border-black rounded-2xl bg-white">
            <div class="pb-5">
                <h1 class="font-bold text-2xl">Tytuł: {{ $task->title }}</h1>
            </div>
            <div class="px-8 py-2 justify-items-center">
                <h1 class="font-bold text-2xl">Instrukcja:</h1>
                <textarea name="description"  cols="100" rows="15" readonly='true' class="rounded-xl">{{ $task->description }}</textarea>
            </div>
            <div class="py-5">
                <a href="{{ route('tasks.index') }}" class="bg-indigo-500 px-3 py-3 rounded-2xl text-white text-xl font-bold hover:bg-indigo-600 transition">POWRÓT</a>
                <a href="{{ route('tasks.instruction.edit', $task) }}" class="bg-indigo-500 px-3 py-3 rounded-2xl text-white text-xl font-bold hover:bg-indigo-600 transition">EDYTUJ</a>
            </div>
             
        </div>
        
        
    </main>
</body>
</html>



