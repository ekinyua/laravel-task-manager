<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @role('admin')
            <nav class="text-blue-500 space-x-4">
                <a href="{{ route('admin.users') }}" class="underline ">Manage Users</a>
                <a href="{{ route('admin.roles') }}" class="underline">Manage Roles</a>
                <a href="{{ route('admin.permissions') }}" class="underline">Manage Permissions</a>
            </nav>
        @endrole

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
