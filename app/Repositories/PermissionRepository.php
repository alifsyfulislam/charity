<?php


namespace App\Repositories;


use App\Models\Permission;

class PermissionRepository
{
    public function listing($request)
    {

        return Permission::orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return Permission::findorfail($id);

    }

    public function create(array  $data)
    {

        $permission                     = new Permission;
        $permission->name               = $data['name'];
        $permission->slug               = $data['slug'];
        $permission->details            = $data['details'];
        $permission->save();
        return $permission;
    }

    public function update(array $data, $id)
    {

        $permission                     = Permission::findorfail($id);
        $permission->name               = $data['name'];
        $permission->slug               = $data['slug'];
        $permission->details            = $data['details'];
        $permission->save();
        return $permission;
    }

    public function delete($id)
    {

        $permission                     = Permission::findorfail($id);
        return $permission->delete();
    }

    public function checkPermissionName(array $data)
    {

        $permission                           = Permission::where('name',$data['name'])->get();
        return $permission;
    }
}
