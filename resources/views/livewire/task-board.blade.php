<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">My Tasks</h2>

    @if (session()->has('message'))
        <div class="text-green-600 mb-3">{{ session('message') }}</div>
    @endif

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left px-2 py-1">Title</th>
                <th class="text-left px-2 py-1">Status</th>
                <th class="text-left px-2 py-1">Deadline</th>
                <th class="text-left px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr class="border-t">
                    <td class="px-2 py-1">{{ $task->title }}</td>
                    <td class="px-2 py-1 rounded-md {{ $task->status === 'Pending' ? 'bg-yellow-500' :
       ($task->status === 'In Progress' ? 'bg-gray-500 text-white' :
       ($task->status === 'Completed' ? 'bg-green-500' : '') ) }}">{{ $task->status }}</td>
                    <td class="px-2 py-1">{{ $task->deadline?->toDayDateTimeString() ?? 'No due date' }}</td>
                    <td class="px-2 py-1 space-x-2">
                        @if($task->status !== 'Completed')
                            <select wire:change="updateStatus({{ $task->id }}, $event.target.value)"
                                    class="border rounded px-1 py-1">
                                <option disabled selected>Change status</option>
                                {{-- @if($task->status === 'Pending') --}}
                                    <option value="In Progress">Mark as In Progress</option>
                                {{-- @endif --}}
                                {{-- @if($task->status !== 'Completed') --}}
                                    <option value="Completed">Mark as Completed</option>
                                {{-- @endif --}}
                            </select>
                        @else
                            <span class="text-green-600 font-semibold">✔ Done</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">No tasks assigned yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
