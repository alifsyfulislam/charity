<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoleService
{
    protected $roleRepository;
    protected $userRepository;

    public function __construct(RoleRepository $roleRepository, UserRepository $userRepository)
    {

        $this->roleRepository       = $roleRepository;
        $this->userRepository       = $userRepository;

    }


    public function listItems($request)
    {

        DB::beginTransaction();

        try{

            $listing                = $this->roleRepository->listing($request);

        }catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return response()->json([
                'status'            => 424,
                'messages'          => config('status.status_code.424'),
                'error'             => $e->getMessage()
            ]);
        }

        DB::commit();

        return response()->json([
            'status'                => 200,
            'messages'              => config('status.status_code.200'),
            'role_list'             => $listing
        ]);
    }

    public function showItem($id)
    {

        DB::beginTransaction();

        try{

            $role                   = $this->roleRepository->show($id);

        }catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return response()->json([
                'status'            => 424,
                'messages'          => config('status.status_code.424'),
                'error'             => $e->getMessage()
            ]);
        }

        DB::commit();

        return response()->json([
            'status'                => 200,
            'message'               => config('status.status_code.200'),
            'role_info'             => $role
        ]);
    }


    public function createItem($request)
    {
        $validator = Validator::make($request->all(),[

            'name'                  => 'required|string|max:50|min:3|unique:roles',
            'permission'            => 'required',

        ]);

        if($validator->fails()) {

            return response()->json([
                'status'            => 400,
                'messages'          => config('status.status_code.400'),
                'errors'            => $validator->errors()->all()
            ]);

        }
        $data                       = $request->all();
        $data['slug']               = Helper::slugify($request->name);

        DB::beginTransaction();

        try{

            $role_info              = $this->roleRepository->create($data);
            $role_info->permissions()->attach($request->input('permission'));
            $role_info              = $this->roleRepository->show($role_info->id);

        }catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return response()->json([
                'status'            => 424,
                'messages'          => config('status.status_code.424'),
                'error'             => $e->getMessage()
            ]);
        }

        DB::commit();

        return response()->json([
            'status'                => 200,
            'message'               => config('status.status_code.200'),
            'role_created'          => $role_info
        ]);
    }

    public function updateItem($request,$id)
    {
        $validator = Validator::make($request->all(),[
            'name'                  => "required|string|max:50|min:3|unique:roles,name,$id,id",
            'permission'            => 'required',
        ]);

        if($validator->fails()) {

            return response()->json([
                'status'            => 400,
                'messages'          => config('status.status_code.400'),
                'errors'            => $validator->errors()->all()
            ]);

        }

        $data                       = $request->all();

        if (isset($data['name'])){
            $data['slug']           = Helper::slugify($data['name']);
        }

        DB::beginTransaction();

        try{

            $this->roleRepository->update($data,$id);
            $role_info              = $this->roleRepository->show($id);
            DB::table('roles_permissions')->where('role_id', $id)->delete();
            $role_info->permissions()->attach($request->input('permission'));
            $role_info              = $this->roleRepository->show($id);
            //role updated with permission at the same time users permission updated
            if (isset($role_info->users)){
                $users_info = [];
                foreach ($role_info->users as $aUser){
                    DB::table('users_permissions')->where('user_id', $aUser->id)->delete();
                    $this->userRepository->show($aUser->id);
                    array_push($users_info, $this->userRepository->show($aUser->id));
                }
            }

            if (isset($role_info->permissions)){
                foreach ($role_info->permissions as $aPermission){
                    foreach ($users_info as $aUser){
                        $aUser->permissions()->attach($aPermission);
                    }
                }
            }

        }catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return response()->json([
                'status'            => 424,
                'messages'          =>config('status.status_code.424'),
                'error'             => $e->getMessage()
            ]);
        }

        DB::commit();

        return response()->json([
            'status'                => 200,
            'messages'              => config('status.status_code.200'),
            'role_info'             => $role_info
        ]);
    }


    public function deleteItem($id)
    {

        DB::beginTransaction();

        try{
            DB::table('roles_permissions')->where('role_id', $id)->delete();
            $this->roleRepository->delete($id);

        }catch (Exception $e) {

            DB::rollBack();

            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return response()->json([
                'status'            => 424,
                'messages'          => config('status.status_code.424'),
                'error'             => $e->getMessage()
            ]);
        }

        DB::commit();

        return response()->json([
            'status'                => 200,
            'message'               => config('status.status_code.200'),
        ]);

    }


    public function changeItemStatus($request, $id)
    {
        $data                       = $request->all();

        DB::beginTransaction();

        try{

            if (isset($data['status'])){
                $this->roleRepository->changeItemStatus($data, $id);
            }
            $role_info              = $this->roleRepository->show($id);

        }catch (Exception $e) {

            DB::rollBack();

            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return response()->json([
                'status'            => 424,
                'messages'          => config('status.status_code.424'),
                'error'             => $e->getMessage()
            ]);
        }

        DB::commit();

        return response()->json([
            'status'                => 200,
            'message'               => config('status.status_code.200'),
            'role_info'             => $role_info
        ]);

    }
}
