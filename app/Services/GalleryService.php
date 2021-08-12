<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Models\Media;
use App\Repositories\GalleryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GalleryService
{

    protected $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {

        $this->galleryRepository    = $galleryRepository;

    }


    public function listItems($request)
    {

        DB::beginTransaction();

        try{

            $listing                = $this->galleryRepository->listing($request);

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
            'gallery_list'          => $listing
        ]);
    }



    public function showItem($id)
    {

        DB::beginTransaction();

        try{

            $gallery                 = $this->galleryRepository->show($id);

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
            'gellery_info'          => $gallery
        ]);
    }



    public function createItem($request)
    {
        $validator = Validator::make($request->all(),[

            'name'                  => 'required|string|max:200|min:3|unique:galleries',
            'event_id'              => 'required',
            'image'                 => 'mimes:jpeg,jpg,png,gif|required|max:10000'

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
        $data['slug']               = Helper::slugify($request->name);

        DB::beginTransaction();

        try{

            $this->galleryRepository->create($data);
            $gallery_info            = $this->galleryRepository->show($data['id']);

            if($request->hasFile('image')) {

                $imageUrl           = Helper::base64GalleryImageStore("uploads/gallery/", $request->image);

                $gallery_info->media()->create([

                    'url'           => $imageUrl

                ]);
            }
            $gallery_info            = $this->galleryRepository->show($data['id']);

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
            'gallery_created'       => $gallery_info
        ]);
    }


    public function updateItem($request,$id)
    {
        $validator = Validator::make($request->all(),[
            'name'                  => "required|string|max:200|min:3|unique:galleries,name,$id,id",
            'event_id'              => 'required',
//            'image'                 => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        if($validator->fails()) {

            return response()->json([
                'status'            => 400,
                'messages'          => config('status.status_code.400'),
                'errors'            =>  $validator->errors()->all()
            ]);

        }

        $data                       = $request->all();

        if (isset($data['name'])){
            $data['slug']           = Helper::slugify($data['name']);
        }

        DB::beginTransaction();

        try{

            $this->galleryRepository->update($data,$id);
            $gallery_info           = $this->galleryRepository->show($id);

            if($request->hasFile('image')) {

                $media              = Media::where('mediable_id', $id)->first();

                if (isset($media)){
                    $fileName       = basename(parse_url($media->url, PHP_URL_PATH));
                    unlink('uploads/gallery/'.$fileName);
//                    $media->delete();
                }

                $imageUrl           = Helper::base64GalleryImageStore("uploads/gallery/", $request->image);

                $gallery_info->media()->update([

                    'url'           => $imageUrl

                ]);
                $gallery_info       = $this->galleryRepository->show($id);
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
            'gallery_info'          => $gallery_info
        ]);
    }


    public function deleteItem($id)
    {

        DB::beginTransaction();

        try{

            $this->galleryRepository->delete($id);

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
                $this->galleryRepository->changeItemStatus($data, $id);
            }
            $gallery_info            = $this->galleryRepository->show($id);

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
            'gallery_info'          => $gallery_info
        ]);

    }

    public function checkUniqueIdentity($request)
    {
        $data                       = $request->all();

        DB::beginTransaction();

        try{

            if (isset($data['name'])){
                $gallery_info       = $this->galleryRepository->checkGalleryName($data);
            }

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

        if (count($gallery_info) == 0){
            return response()->json([
                'status'                => 200,
                'message'               => config('status.status_code.200'),
                'availability'          => 'Available'
            ]);
        }else{
            return response()->json([
                'status'                => 200,
                'message'               => config('status.status_code.200'),
                'availability'          => 'Taken'
            ]);
        }
    }

}
