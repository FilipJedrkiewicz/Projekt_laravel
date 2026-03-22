<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
   }
   public function store(Request $request)
   {
        $request->validate([
            'title' => 'required|string|max:255' ,
        ]);

        Task::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return redirect()->back();
   }
   public function destroy(Task $task)
   {
        $task->delete();

        return redirect()->back();
   }
}
