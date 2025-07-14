<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Task Manager</h2>

    @if (session()->has('message'))
        <div class="text-green-600 mb-2">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'updateTask' : 'createTask' }}" class="mb-6">
        <input type="text" wire:model="title" placeholder="Task title" class="border rounded px-2 py-1 mr-2">
        <select wire:model="user_id" class="border rounded px-2 py-1 mr-2">
            <option value="">Assign to...</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <input type="datetime-local" wire:model="deadline" class="border rounded px-2 py-1 mr-2" required>
        @if ($isEditMode)
            <select wire:model="status" class="border rounded px-2 py-1 mr-2">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        @endif
        <button class=" bg-blue-500 text-white px-4 py-1 rounded">
            {{ $isEditMode ? 'Update' : 'Create' }}
        </button>
        @if ($isEditMode)
            <button type="button" wire:click="resetForm" class="ml-2 text-gray-500 underline">Cancel</button>
        @endif
    </form>

    <table class="w-full border-collapse table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-2 py-1">Title</th>
                <th class="px-2 py-1">User</th>
                <th class="px-2 py-1">Status</th>
                <th class="px-2 py-1">Deadline</th>
                <th class="px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr class="border-t space-y-2">
                    <td class="px-2 py-1">{{ $task->title }}</td>
                    <td class="px-2 py-1">{{ $task->user->name }}</td>
                    <td class="px-2 py-1 rounded-md {{ $task->status === 'Pending' ? 'bg-yellow-500' :
       ($task->status === 'In Progress' ? 'bg-gray-500 text-white' :
       ($task->status === 'Completed' ? 'bg-green-500' : '') ) }}">{{ $task->status }}</td>
                    <td class="px-2 py-1">{{ \Carbon\Carbon::parse($task->deadline)->toDayDateTimeString() ?? null}}</td>
                    <td class="px-2 py-1 space-x-2">
                        <button wire:click="editTask({{ $task->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="deleteTask({{ $task->id }})" class="text-red-600" onclick="return confirm('Sure?')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
