<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CauseService;
use Illuminate\Http\Request;

class CauseController extends Controller
{
    protected $causeService;

    public function __construct(CauseService $causeService)
    {
        // $this->middleware('acl:super-admin');
        $this->causeService = $causeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->causeService->listItems($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->causeService->createItem($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->causeService->showItem($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->causeService->updateItem($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->causeService->deleteItem($id);
    }

    public function changeItemStatus(Request $request, $id)
    {

        return $this->causeService->changeItemStatus($request, $id);

    }

    public function checkUniqeInfo(Request $request)
    {

        return $this->causeService->checkUniqueIdentity($request);
    }
}
