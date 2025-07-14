<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Manage Users</h2>

    @if (session()->has('message'))
        <div x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        class="text-green-600 mb-4 transition-all duration-500 ease-in-out"">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="{{ $isEditMode ? 'updateUser' : 'createUser' }}" class="mb-6 space-y-2">
        <input type="text" wire:model="name" placeholder="Name" class="border rounded px-2 py-1 w-full">
        <input type="email" wire:model="email" placeholder="Email" class="border rounded px-2 py-1 w-full">
        @if (!$isEditMode)
            <input type="password" wire:model="password" placeholder="Password" class="border rounded px-2 py-1 w-full">
            <input type="password" wire:model="password_confirmation" placeholder="Confirm Password" class="border rounded px-2 py-1 w-full">
        @else
            <input type="password" wire:model="password" placeholder="New Password (optional)" class="border rounded px-2 py-1 w-full">
            <input type="password" wire:model="password_confirmation" placeholder="Confirm Password" class="border rounded px-2 py-1 w-full">
        @endif

        <select wire:model="role" class="border rounded px-2 py-1 w-full">
            <option value="">Select Role</option>
            @foreach($roles as $r)
                <option value="{{ $r->name }}">{{ ucfirst($r->name) }}</option>
            @endforeach
        </select>

        <div class="space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">
                {{ $isEditMode ? 'Update' : 'Create' }}
            </button>
            @if($isEditMode)
                <button type="button" wire:click="resetForm" class="text-gray-500 underline">Cancel</button>
            @endif
        </div>
    </form>

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-2 py-1">Name</th>
                <th class="px-2 py-1">Email</th>
                <th class="px-2 py-1">Role</th>
                <th class="px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-t">
                    <td class="px-2 py-1">{{ $user->name }}</td>
                    <td class="px-2 py-1">{{ $user->email }}</td>
                    <td class="px-2 py-1">{{ $user->roles->pluck('name')->first() ?? '-' }}</td>
                    <td class="px-2 py-1 space-x-2">
                        <button wire:click="editUser({{ $user->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="deleteUser({{ $user->id }})" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
