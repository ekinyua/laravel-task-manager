<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskAssigned;

class TaskManager extends Component
{
    public $tasks, $users;
    public $taskId, $title, $description, $deadline, $user_id, $status = 'Pending';
    public $isEditMode = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->tasks = Task::with('user')->latest()->get();
        $this->users = User::all();
    }

    public function createTask()
    {
        $this->validate([
            'title' => 'required',
            'user_id' => 'required|exists:users,id',
            // 'deadline' => 'required|date',
        ]);

        $task = Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'deadline' => $deadline = isset($this->deadline) ? $this->deadline : null,
            'user_id' => $this->user_id,
            'status' => 'Pending',
        ]);

        // send email
        // Mail::to($task->user->email)->send(new TaskAssigned($task));

        $this->resetForm();
        $this->loadData();
        session()->flash('message', 'Task created and email sent.');
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->deadline = $task->deadline;
        $this->user_id = $task->user_id;
        $this->status = $task->status;
        $this->isEditMode = true;
    }

    public function updateTask()
    {
        $this->validate([
            'title' => 'required',
            'user_id' => 'required|exists:users,id',
            // 'deadline' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $task = Task::find($this->taskId);
        $task->update([
            'title' => $this->title,
            'description' => $this->description,
            'deadline' => $this->deadline ?? null,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);

        $this->resetForm();
        $this->loadData();
        session()->flash('message', 'Task updated.');
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
        $this->loadData();
        session()->flash('message', 'Task deleted.');
    }

    public function resetForm()
    {
        $this->taskId = null;
        $this->title = '';
        $this->description = '';
        $this->deadline = '';
        $this->user_id = '';
        $this->status = 'Pending';
        $this->isEditMode = false;
    }

    public function render()
    {
        return view('livewire.admin.task-manager')->layout('layouts.app');
    }
}
