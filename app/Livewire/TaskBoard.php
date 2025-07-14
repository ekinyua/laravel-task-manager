<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskBoard extends Component
{
    public $tasks;

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = Task::where('user_id', Auth::id())->latest()->get();
    }

    public function updateStatus($taskId, $newStatus)
    {
        $task = Task::where('id', $taskId)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $task->update(['status' => $newStatus]);

        $this->loadTasks();
        session()->flash('message', 'Task status updated.');
    }

    public function render()
    {
        return view('livewire.task-board')->layout('layouts.app');
    }
}
