<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::orderBy('is_completed', 'desc')->orderByRaw('due_date < NOW() AND is_completed = 0 ASC')
            ->orderByRaw('FIELD(priority, "high", "medium", "low") ASC');
        if ($request->category == 'completed') {
            $query->where('is_completed', true);
        } else if ($request->category == 'active') {
            $query->where('is_completed', false)->where(function ($q) {
                $q->where('due_date', '>=', now())
                    ->orWhereNull('due_date');
            });
        }
        if ($request->category == 'priority-asc') {
            $query->reorder()->orderByRaw('FIELD(priority, "low", "medium", "high") ASC');
        } else if ($request->category == 'priority-desc') {
            $query->reorder()->orderByRaw('FIELD(priority, "high", "medium", "low") ASC');
        } else if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->category == 'priority-asc') {
            $query->reorder()->orderByRaw('FIELD(priority, "low", "medium", "high") ASC');
        } else if ($request->category == 'priority-desc') {
            $query->reorder()->orderByRaw('FIELD(priority, "high", "medium", "low") ASC');
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('author', 'like', "%{$request->search}%");
            });
        }
        $tasks = $query->paginate(20)->withQueryString();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $description = null;

        if ($request->hasFile('instruction')) {
            $description = file_get_contents($request->file('instruction')->getRealPath());
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'is_completed' => false,
            'due_date' => $request->due_date,
            'author' => $request->author,
            'category' => $request->category,
            'priority' => $request->priority,
            'description' => $description,
        ]);

        return redirect()->back();
    }


    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back();
    }


    public function update(Request $request, Task $task)
    {
        if ($request->has('title')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'due_date' => 'required|date',
                'author' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'priority' => 'required|string|max:255',
            ]);
            $task->update([
                'title' => $request->title,
                'due_date' => $request->due_date,
                'is_completed' => $request->has('is_completed'),
                'author' => $request->author,
                'category' => $request->category,
                'priority' => $request->priority,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Zadanie zaktualizowane!');
        }
        $task->update([
            'is_completed' => $request->has('is_completed')
        ]);
        return redirect()->back()->with('success', 'Status zaktualizowany!');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function reset()
    {
        \App\Models\Task::truncate();
        return redirect()->back()->with('success', 'wszystkie dane zostaly usuniete!');
    }

    public function instruction(Task $task)
    {
        return view('tasks.instruction', compact('task'));
    }
}
