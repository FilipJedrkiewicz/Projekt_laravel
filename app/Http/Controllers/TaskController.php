<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{


    public function index()
    {
        $tasks = Task::orderBy('is_completed', 'desc')->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'title' => $request->title,
            'is_completed' => false,
            'due_date' => $request->due_date,
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
            ]);
            $task->update([
                'title' => $request->title,
                'due_date' => $request->due_date,
                'is_completed' => $request->has('is_completed')
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
}
