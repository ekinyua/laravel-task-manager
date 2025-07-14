<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManager extends Component
{
    public $roles, $name, $roleIdToUpdate;
    public $isEditMode = false;

    public function mount()
    {
        $this->loadRoles();
    }

    public function loadRoles()
    {
        $this->roles = Role::with('permissions')->get();
    }

    public function createRole()
    {
        $this->validate(['name' => 'required|unique:roles,name']);
        Role::create(['name' => $this->name]);
        $this->resetForm();
        $this->loadRoles();
        session()->flash('message', 'Role created.');
    }

    public function editRole($id)
    {
        $role = Role::find($id);
        $this->roleIdToUpdate = $role->id;
        $this->name = $role->name;
        $this->isEditMode = true;
    }

    public function updateRole()
    {
        $this->validate(['name' => 'required|unique:roles,name,' . $this->roleIdToUpdate]);
        $role = Role::find($this->roleIdToUpdate);
        $role->name = $this->name;
        $role->save();
        $this->resetForm();
        $this->loadRoles();
        session()->flash('message', 'Role updated.');
    }

    public function deleteRole($id)
    {
        Role::find($id)->delete();
        $this->loadRoles();
        session()->flash('message', 'Role deleted.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->roleIdToUpdate = null;
        $this->isEditMode = false;
    }



    public function render()
    {
        return view('livewire.admin.role-manager')->layout('layouts.app');
    }
}
