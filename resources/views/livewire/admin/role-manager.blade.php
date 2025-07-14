<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Role Manager</h2>

    @if (session()->has('message'))
        <div class="text-green-600 mb-3">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'updateRole' : 'createRole' }}">
        <input type="text" wire:model="name" placeholder="Role name" class="border px-2 py-1 rounded">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">
            {{ $isEditMode ? 'Update' : 'Create' }}
        </button>
        @if ($isEditMode)
            <button type="button" wire:click="resetForm" class="ml-2 text-gray-500 underline">Cancel</button>
        @endif
    </form>

    <table class="mt-6 w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left px-2 py-1">Name</th>
                <th class="text-left px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr class="border-t">
                    <td class="px-2 py-1">{{ $role->name }}</td>
                    <td class="px-2 py-1 space-x-2">
                        <button wire:click="editRole({{ $role->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="deleteRole({{ $role->id }})" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
