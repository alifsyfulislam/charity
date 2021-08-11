<?php


namespace App\Helpers;


use Image;

class Helper
{
    public static function idGenarator()
    {

        return time().rand(1000,9000);
    }

    public static function slugify($value)
    {

        return strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $value));

    }

    public static function slugifyFullName($first_name,$middle_name='',$last_name){
        return strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $first_name.' '.$middle_name.' '.$last_name));
    }

    public static function base64ServiceImageStore($url, $image)
    {
        if (!file_exists(public_path($url))) {
            mkdir(public_path($url), 777, true);
        }
        $filename = date('Ymdhis')."-".strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "-", $image->getClientOriginalName()));
        Image::make($image->getRealPath())->resize(49, 61)->save($url.$filename);
        return url($url.$filename);
    }

    public static function base64EventImageStore($url, $image)
    {
        if (!file_exists(public_path($url))) {
            mkdir(public_path($url), 777, true);
        }
        $filename = date('Ymdhis')."-".strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "-", $image->getClientOriginalName()));
        Image::make($image->getRealPath())->save($url.$filename);
        return url($url.$filename);
    }

    public static function base64CauseImageStore($url, $image)
    {
        if (!file_exists(public_path($url))) {
            mkdir(public_path($url), 777, true);
        }
        $filename = date('Ymdhis')."-".strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "-", $image->getClientOriginalName()));
        Image::make($image->getRealPath())->save($url.$filename);
        return url($url.$filename);
    }

    public static function base64GalleryImageStore($url, $image)
    {
        if (!file_exists(public_path($url))) {
            mkdir(public_path($url), 777, true);
        }
        $filename = date('Ymdhis')."-".strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "-", $image->getClientOriginalName()));
        Image::make($image->getRealPath())->save($url.$filename);
        return url($url.$filename);
    }

    public static function base64AvatarImageStore($url, $image)
    {
        if (!file_exists(public_path($url))) {
            mkdir(public_path($url), 777, true);
        }
        $filename = date('Ymdhis')."-".strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "-", $image->getClientOriginalName()));
        Image::make($image->getRealPath())->save($url.$filename);
        return url($url.$filename);
    }


    public static function base64AboutImageStore($url, $image)
    {
        if (!file_exists(public_path($url))) {
            mkdir(public_path($url), 777, true);
        }
        $filename = date('Ymdhis')."-".strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "-", $image->getClientOriginalName()));
        Image::make($image->getRealPath())->save($url.$filename);
        return url($url.$filename);
    }

}