<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Repositories\ContactRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {

        $this->contactRepository     = $contactRepository;

    }

    public function listItems($request)
    {

        DB::beginTransaction();

        try{

            $listing                = $this->contactRepository->listing($request);

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
            'contact_list'          => $listing
        ]);
    }


    public function showItem($id)
    {

        DB::beginTransaction();

        try{

            $contact                 = $this->contactRepository->show($id);

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
            'contact_info'          => $contact
        ]);
    }


    public function createItem($request)
    {
        $validator = Validator::make($request->all(),[

            'subject'               => 'required|string|max:200|min:3',
            'email'                 => 'required|string|max:60',
            'body'                  => 'required',

        ]);

        if($validator->fails()) {

            return response()->json([
                'status'            => 400,
                'messages'          => config('status.status_code.400'),
                'errors'            => $validator->errors()->all()
            ]);

        }
        $data                       = $request->all();

        DB::beginTransaction();

        try{

            $contact_info           = $this->contactRepository->create($data);

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
            'contact_created'       => $contact_info
        ]);
    }


    public function updateItem($request,$id)
    {
        $validator = Validator::make($request->all(),[
            'subject'               => 'required|string|max:200|min:3',
            'email'                 => 'required|string|max:60',
            'body'                  => 'required',
        ]);

        if($validator->fails()) {

            return response()->json([
                'status'            => 400,
                'messages'          => config('status.status_code.400'),
                'errors'            => $validator->errors()->all()
            ]);

        }

        $data                       = $request->all();


        DB::beginTransaction();

        try{

            $this->contactRepository->update($data,$id);
            $contact_info           = $this->contactRepository->show($id);

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
            'contact_info'          => $contact_info
        ]);
    }


    public function deleteItem($id)
    {

        DB::beginTransaction();

        try{

            $this->contactRepository->delete($id);

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
                $this->contactRepository->changeItemStatus($data, $id);
            }
            $contact_info           = $this->contactRepository->show($id);

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
            'contact_info'          => $contact_info
        ]);

    }
}