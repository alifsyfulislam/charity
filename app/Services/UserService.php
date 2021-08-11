<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Models\Media;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserService
{

    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {

        $this->userRepository       = $userRepository;
        $this->roleRepository       = $roleRepository;

    }

    public function listItems($request)
    {

        DB::beginTransaction();

        try{

            $listing                = $this->userRepository->listing($request);

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
            'user_list'             => $listing
        ]);
    }


    public function showItem($id)
    {

        DB::beginTransaction();

        try{

            $user                  = $this->userRepository->show($id);

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
            'user_info'             => $user
        ]);
    }


    public function createItem($request)
    {
        $validator = Validator::make($request->all(),[

            'first_name'            => 'required|string|max:50|min:2',
            'last_name'             => 'required|string|max:50|min:2',
            'username'              => 'required|string|max:50|min:4|unique:users',
            'email'                 => 'required|string|max:60|unique:users',
            'mobile'                => 'required|string|max:50|min:8|unique:users',
            'password'              => 'required|same:confirm_password',
            'image'                 => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'roles'                 => 'required'
        ]);

        if($validator->fails()) {

            return response()->json([
                'status'            => 400,
                'messages'          => config('status.status_code.400'),
                'errors'            => $validator->errors()->all()
            ]);

        }
        $data                       = $request->all();
        $data['id']                 = Helper::idGenarator();
        $data['slug']               = Helper::slugifyFullName($request->first_name,$request->middle_name,$request->last_name);

        DB::beginTransaction();

        try{

            $this->userRepository->create($data);
            $user_info              = $this->userRepository->show($data['id']);

            $userRole               = $this->roleRepository->show($request->input('roles'));

            if (isset($userRole->permissions)){
                foreach ($userRole->permissions as $aPermission){
                    $user_info->permissions()->attach($aPermission);
                }
            }

            $user_info->roles()->attach($request->input('roles'));

            if($request->hasFile('image')) {

                $imageUrl           = Helper::base64AvatarImageStore("uploads/avatar/", $request->image);

                $user_info->media()->create([

                    'url'           => $imageUrl

                ]);
            }
            $user_info              = $this->userRepository->show($data['id']);

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
            'user_created'          => $user_info
        ]);
    }

    public function updateItem($request,$id)
    {
        $validator = Validator::make($request->all(),[
            'first_name'            => 'required|string|max:50|min:2',
            'last_name'             => 'required|string|max:50|min:2',
            'username'              => "required|string|max:50|min:4|unique:users,username,$id,id",
            'email'                 => "required|string|max:60|unique:users,email,$id,id",
            'mobile'                => "required|string|max:50|min:8|unique:users,mobile,$id,id",
//            'image'                 => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            'roles'                 => 'required'
        ]);

        if($validator->fails()) {

            return response()->json([
                'status'            => 400,
                'messages'          => config('status.status_code.400'),
                'errors'            =>  $validator->errors()->all()
            ]);

        }

        $data                       = $request->all();

        if (isset($data['first_name']) && isset($data['last_name'])){
            $data['slug']           = Helper::slugifyFullName($request->first_name,$request->middle_name,$request->last_name);
        }

        DB::beginTransaction();

        try{

            $this->userRepository->update($data,$id);
            $user_info              = $this->userRepository->show($id);

            DB::table('users_roles')->where('user_id', $id)->delete();
            DB::table('users_permissions')->where('user_id', $id)->delete();
            $userRole               = $this->roleRepository->show($request->input('roles'));

            if (isset($userRole->permissions)){
                foreach ($userRole->permissions as $aPermission){
                    $user_info->permissions()->attach($aPermission);
                }
            }

            $user_info->roles()->attach($request->input('roles'));

            if($request->hasFile('image')) {

                $media              = Media::where('mediable_id', $id)->first();

                if (isset($media)){
                    $fileName       = basename(parse_url($media->url, PHP_URL_PATH));
                    unlink('uploads/avatar/'.$fileName);
//                    $media->delete();
                }

                $imageUrl           = Helper::base64AvatarImageStore("uploads/avatar/", $request->image);

                $user_info->media()->update([

                    'url'           => $imageUrl

                ]);
                $user_info          = $this->userRepository->show($id);
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
            'user_info'             => $user_info
        ]);
    }

    public function deleteItem($id)
    {

        DB::beginTransaction();

        try{
            DB::table('users_roles')->where('user_id', $id)->delete();
            DB::table('users_permissions')->where('user_id', $id)->delete();
            $this->userRepository->delete($id);
            DB::table('users_roles')->where('user_id', $id)->delete();

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
                $this->userRepository->changeItemStatus($data, $id);
            }
            $user_info              = $this->userRepository->show($id);

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
            'user_info'             => $user_info
        ]);

    }

}