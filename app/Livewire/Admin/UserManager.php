<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    public $users, $roles;
    public $name, $email, $password, $password_confirmation, $role;
    public $userIdToEdit;
    public $isEditMode = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->users = User::with('roles')->get();
        $this->roles = Role::all();
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:password_confirmation',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->role);

        $this->resetForm();
        $this->loadData();
        session()->flash('message', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        $this->userIdToEdit = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()?->name;
        $this->isEditMode = true;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->userIdToEdit,
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($this->userIdToEdit);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($this->password) {
            $this->validate(['password' => 'min:6|same:password_confirmation']);
            $user->update(['password' => Hash::make($this->password)]);
        }

        $user->syncRoles([$this->role]);

        $this->resetForm();
        $this->loadData();
        session()->flash('message', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        $this->loadData();
        session()->flash('message', 'User deleted.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->userIdToEdit = null;
        $this->isEditMode = false;
    }

    public function assignRole($userId, $roleName)
    {
        $user = User::find($userId);
        $user->syncRoles([$roleName]);
        $this->mount(); // Refresh list
        session()->flash('message', 'Role updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.user-manager')->layout('layouts.app');
    }
}
