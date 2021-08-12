<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public function listing($request)
    {

        return User::with('media','roles.permissions')->orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return User::with('media','roles.permissions')->findorfail($id);

    }
    public function create(array  $data)
    {

        $user                      = new User();
        $user->id                  = $data['id'];
        $user->first_name          = $data['first_name'];
        $user->middle_name         = $data['middle_name'];
        $user->last_name           = $data['last_name'];
        $user->username            = $data['username'];
        $user->slug                = $data['slug'];
        $user->email               = $data['email'];
        $user->mobile              = $data['mobile'];
        $user->password            = bcrypt($data['password']);
        $user->address             = $data['address'];
        $user->status              = $data['status'];
        $user->save();
        return $user;
    }

    public function update(array $data, $id)
    {

        $user                      = User::with('media','roles.permissions')->findorfail($id);
        $user->first_name          = $data['first_name'];
        $user->middle_name         = $data['middle_name'];
        $user->last_name           = $data['last_name'];
        $user->username            = $data['username'];
        $user->slug                = $data['slug'];
        $user->email               = $data['email'];
        $user->mobile              = $data['mobile'];
        $user->address             = $data['address'];
        $user->status              = $data['status'];
        $user->save();
        return $user;
    }

    public function delete($id)
    {

        $user                      = User::with('media','roles.permissions')->findorfail($id);

        if (count($user->media) > 0){
            foreach ($user->media as $aFile)
            {
                $fileName          = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/avatar/'.$fileName);
                $aFile->delete();
            }
        }
        return $user->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $user                     = User::with('media','roles.permissions')->findorfail($id);
        $user->status             = $data['status'];
        $user->save();
        return $user;
    }

    public function checkUserName(array $data){
        $user                     = User::where('username',$data['username'])->get();
        return $user;
    }

    public function checkUserEmail(array $data){
        $user                     = User::where('email',$data['email'])->get();
        return $user;
    }

    public function checkUserMobile(array $data){
        $user                     = User::where('mobile',$data['mobile'])->get();
        return $user;
    }
}
