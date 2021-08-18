<?php


namespace App\Repositories;


use App\Models\Service;

class ServiceRepository
{
    public function listing($request)
    {
        if($request->filled('isVisitor')){
            return Service::with('media')
                ->orderBy('created_at','DESC')
                ->take(3)
                ->get();
        }
        else{
            return Service::with('media')
                ->orderBy('created_at','DESC')
                ->paginate(15);
        }



    }

    public function show($id)
    {

        return Service::with('media')->findorfail($id);

    }

    public function create(array  $data)
    {

        $service                    = new Service;
        $service->id                = $data['id'];
        $service->name              = $data['name'];
        $service->slug              = $data['slug'];
        $service->details           = $data['details'];
        $service->status            = $data['status'];
        $service->save();
        return $service;
    }

    public function update(array $data, $id)
    {

        $service                    = Service::with('media')->findorfail($id);
        $service->name              = $data['name'];
        $service->slug              = $data['slug'];
        $service->details           = $data['details'];
        $service->status            = $data['status'];
        $service->save();
        return $service;
    }

    public function delete($id)
    {

        $service                    = Service::with('media')->findorfail($id);

        if (count($service->media) > 0){
            foreach ($service->media as $aFile)
            {
                $fileName           = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/service/'.$fileName);
                $aFile->delete();
            }
        }
        return $service->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $service                    = Service::with('media')->findorfail($id);
        $service->status            = $data['status'];
        $service->save();
        return $service;
    }

    public function checkServiceName(array $data)
    {

        $service                    = Service::where('name',$data['name'])->get();
        return $service;
    }
}
