<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Instrukcję - TaskMaster</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal text-gray-900">
    <nav class="bg-indigo-700 p-4 shadow-lg text-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black uppercase tracking-widest">TaskMaster</h1>
            <h1 class="text-xl font-bold uppercase">Edytuj Instrukcję</h1>
            <div class="space-x-4 font-bold">
                <a href="{{ route('tasks.index') }}" class="hover:text-indigo-200">Moje Zadania</a>
            </div>
        </div>
    </nav>

    <main class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-indigo-100">
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Instrukcja dla: <span class="text-indigo-600">{{ $task->title }}</span></h2>
                    <p class="text-gray-500">Wpisz poniżej szczegółową instrukcję lub opis zadania. Treść zostanie automatycznie sformatowana.</p>
                </div>

                <form action="{{ route('tasks.instruction.update', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-6">
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="15" 
                            class="w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-lg p-4 transition duration-200"
                            placeholder="Zacznij pisać swoją instrukcję tutaj..."
                        >{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-gray-800 font-bold transition">
                            Anuluj i wróć
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform active:scale-95 transition duration-200">
                            Zapisz Instrukcję
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
