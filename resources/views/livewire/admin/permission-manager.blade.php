<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Permission Manager</h2>

    @if (session()->has('message'))
        <div class="text-green-600 mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'updatePermission' : 'createPermission' }}">
        <input type="text" wire:model="name" placeholder="Permission name" class="border px-2 py-1 rounded">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">
            {{ $isEditMode ? 'Update' : 'Create' }}
        </button>
        @if ($isEditMode)
            <button type="button" wire:click="resetForm" class="ml-2 text-gray-500 underline">Cancel</button>
        @endif
    </form>

    <table class="mt-6 w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-2 py-1">Permission</th>
                @foreach($roles as $role)
                    <th class="px-2 py-1">{{ $role->name }}</th>
                @endforeach
                <th class="px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr class="border-t">
                    <td class="px-2 py-1">{{ $permission->name }}</td>
                    @foreach ($roles as $role)
                        <td class="text-center">
                            <input type="checkbox" wire:click="toggleRolePermission({{ $role->id }}, {{ $permission->id }})"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        </td>
                    @endforeach
                    <td class="px-2 py-1 space-x-2">
                        <button wire:click="editPermission({{ $permission->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="deletePermission({{ $permission->id }})" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
