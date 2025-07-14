<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionManager extends Component
{
    public $permissions, $roles, $name;
    public $permissionIdToUpdate;
    public $isEditMode = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->permissions = Permission::with('roles')->get();
        $this->roles = Role::all();
    }

    public function createPermission()
    {
        $this->validate(['name' => 'required|unique:permissions,name']);
        Permission::create(['name' => $this->name]);
        $this->resetForm();
        $this->loadData();
        session()->flash('message', 'Permission created.');
    }

    public function editPermission($id)
    {
        $perm = Permission::find($id);
        $this->permissionIdToUpdate = $perm->id;
        $this->name = $perm->name;
        $this->isEditMode = true;
    }

    public function updatePermission()
    {
        $this->validate(['name' => 'required|unique:permissions,name,' . $this->permissionIdToUpdate]);
        $perm = Permission::find($this->permissionIdToUpdate);
        $perm->name = $this->name;
        $perm->save();
        $this->resetForm();
        $this->loadData();
        session()->flash('message', 'Permission updated.');
    }

    public function deletePermission($id)
    {
        Permission::find($id)->delete();
        $this->loadData();
        session()->flash('message', 'Permission deleted.');
    }

    public function toggleRolePermission($roleId, $permissionId)
    {
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
        } else {
            $role->givePermissionTo($permission);
        }

        $this->loadData(); // Refresh
    }

    public function resetForm()
    {
        $this->name = '';
        $this->permissionIdToUpdate = null;
        $this->isEditMode = false;
    }

    public function render()
    {
        return view('livewire.admin.permission-manager')->layout('layouts.app');
    }
}
