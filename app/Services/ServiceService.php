<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Models\Media;
use App\Repositories\ServiceRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceService
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {

        $this->serviceRepository    = $serviceRepository;

    }

    public function listItems($request)
    {

        DB::beginTransaction();

        try{

            $listing                = $this->serviceRepository->listing($request);

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
            'service_list'          => $listing
        ]);
    }

    public function showItem($id)
    {

        DB::beginTransaction();

        try{

            $service                = $this->serviceRepository->show($id);

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
            'service_info'          => $service
        ]);
    }

    public function createItem($request)
    {
        $validator = Validator::make($request->all(),[

            'name'                  => 'required|string|max:200|min:3|unique:services',
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

            $this->serviceRepository->create($data);
            $service_info           = $this->serviceRepository->show($data['id']);

            if($request->hasFile('image')) {

                $imageUrl           = Helper::base64ServiceImageStore("uploads/service/", $request->image);

                $service_info->media()->create([

                    'url'           => $imageUrl

                ]);
            }
            $service_info           = $this->serviceRepository->show($data['id']);

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
            'service_created'       => $service_info
        ]);
    }

    public function updateItem($request,$id)
    {
        $validator = Validator::make($request->all(),[
            'name'                  => "required|string|max:200|min:3|unique:services,name,$id,id",
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

            $this->serviceRepository->update($data,$id);
            $service_info           = $this->serviceRepository->show($id);

            if($request->hasFile('image')) {

                $media              = Media::where('mediable_id', $id)->first();

                if (isset($media)){
                    $fileName       = basename(parse_url($media->url, PHP_URL_PATH));
                    unlink('uploads/service/'.$fileName);
//                    $media->delete();
                }

                $imageUrl           = Helper::base64ServiceImageStore("uploads/service/", $request->image);

                $service_info->media()->update([

                    'url'           => $imageUrl

                ]);
                $service_info       = $this->serviceRepository->show($id);
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
            'service_info'          => $service_info
        ]);
    }

    public function deleteItem($id)
    {

        DB::beginTransaction();

        try{

            $this->serviceRepository->delete($id);

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
                $this->serviceRepository->changeItemStatus($data, $id);
            }
            $service_info           = $this->serviceRepository->show($id);

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
            'service_info'          => $service_info
        ]);

    }
}