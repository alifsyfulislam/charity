<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Repositories\ContentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContentService
{
    protected $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {

        $this->contentRepository    = $contentRepository;

    }

    public function listItems($request)
    {

        DB::beginTransaction();

        try{

            $listing                = $this->contentRepository->listing($request);

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
            'content_list'          => $listing
        ]);
    }

    public function showItem($id)
    {

        DB::beginTransaction();

        try{

            $content                = $this->contentRepository->show($id);

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
            'content_info'          => $content
        ]);
    }

    public function createItem($request)
    {

        $data                       = $request->all();

        DB::beginTransaction();

        try{

            $content_info           = $this->contentRepository->create($data);

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
            'content_created'       => $content_info
        ]);
    }

    public function updateItem($request,$id)
    {

        $data                       = $request->all();

        DB::beginTransaction();

        try{

            $this->contentRepository->update($data,$id);
            $content_info           = $this->contentRepository->show($id);

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
            'content_info'          => $content_info
        ]);
    }

    public function deleteItem($id)
    {

        DB::beginTransaction();

        try{

            $this->contentRepository->delete($id);

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
}
