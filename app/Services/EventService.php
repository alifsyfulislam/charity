<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Models\Media;
use App\Repositories\EventRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EventService
{
    protected $serviceRepository;

    public function __construct(EventRepository $eventRepository)
    {

        $this->eventRepository    = $eventRepository;

    }

    public function listItems($request)
    {

        DB::beginTransaction();

        try{

            $listing                = $this->eventRepository->listing($request);

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
            'event_list'            => $listing
        ]);
    }

    public function showItem($id)
    {

        DB::beginTransaction();

        try{

            $event                  = $this->eventRepository->show($id);

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
            'event_info'            => $event
        ]);
    }


    public function createItem($request)
    {
        $validator = Validator::make($request->all(),[

            'name'                  => 'required|string|max:200|min:3|unique:events',
            'location'              => 'required|string|max:50|min:3',
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

            $this->eventRepository->create($data);
            $event_info             = $this->eventRepository->show($data['id']);

            if($request->hasFile('image')) {

                $imageUrl           = Helper::base64EventImageStore("uploads/event/", $request->image);

                $event_info->media()->create([

                    'url'           => $imageUrl

                ]);
            }
            $event_info             = $this->eventRepository->show($data['id']);

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
            'event_created'         => $event_info
        ]);
    }


    public function updateItem($request,$id)
    {
        $validator = Validator::make($request->all(),[
            'name'                  => "required|string|max:200|min:3|unique:events,name,$id,id",
            'location'              => 'required|string|max:50|min:3',
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

            $this->eventRepository->update($data,$id);
            $event_info             = $this->eventRepository->show($id);

            if($request->hasFile('image')) {

                $media              = Media::where('mediable_id', $id)->first();

                if (isset($media)){
                    $fileName       = basename(parse_url($media->url, PHP_URL_PATH));
                    unlink('uploads/event/'.$fileName);
//                    $media->delete();
                }

                $imageUrl           = Helper::base64EventImageStore("uploads/event/", $request->image);

                $event_info->media()->update([

                    'url'           => $imageUrl

                ]);
                $event_info         = $this->eventRepository->show($id);
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
            'event_info'            => $event_info
        ]);
    }

    public function deleteItem($id)
    {

        DB::beginTransaction();

        try{

            $this->eventRepository->delete($id);

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
                $this->eventRepository->changeItemStatus($data, $id);
            }
            $event_info             = $this->eventRepository->show($id);

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
            'event_info'            => $event_info
        ]);

    }


    public function checkUniqueIdentity($request)
    {
        $data                       = $request->all();

        DB::beginTransaction();

        try{

            if (isset($data['name'])){
                $event_info         = $this->eventRepository->checkEventName($data);
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

        if (count($event_info) == 0){
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
