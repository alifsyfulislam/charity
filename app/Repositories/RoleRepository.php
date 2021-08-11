<?php


namespace App\Repositories;


use App\Models\Role;

class RoleRepository
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository       = $userRepository;

    }
    public function listing($request)
    {

        return Role::with('permissions')->orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return Role::with('permissions','users')->findorfail($id);

    }

    public function create(array  $data)
    {

        $role                       = new Role;
        $role->name                 = $data['name'];
        $role->slug                 = $data['slug'];
        $role->details              = $data['details'];
        $role->status               = $data['status'];
        $role->save();
        return $role;
    }

    public function update(array $data, $id)
    {

        $role                       = Role::with('permissions','users')->findorfail($id);
        $role->name                 = $data['name'];
        $role->slug                 = $data['slug'];
        $role->details              = $data['details'];
        $role->status               = $data['status'];
        //as well as all users status will be changed
        if (isset($role->users)){
            foreach ($role->users as $aUser){
                $this->userRepository->changeItemStatus($data, $aUser->id);
            }
        }
        $role->save();
        return $role;
    }

    public function delete($id)
    {

        $role                       = Role::with('permissions','users')->findorfail($id);
        return $role->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $role                       = Role::with('permissions','users')->findorfail($id);
        $role->status               = $data['status'];
        //as well as all users status will be changed
        if (isset($role->users)){
            foreach ($role->users as $aUser){
                $this->userRepository->changeItemStatus($data, $aUser->id);
            }
        }
        $role->save();
        return $role;
    }
}