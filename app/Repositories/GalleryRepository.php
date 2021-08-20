<?php


namespace App\Repositories;


use App\Models\Gallery;

class GalleryRepository
{
    public function listing($request)
    {

        if ($request->filled('isVisibleItem')) {
            return Gallery::with('media')
                ->where('status', '=', 1)
                ->orderBy('created_at', 'DESC')
                ->take($request->isVisibleItem)
                ->get();
        }else{
            return Gallery::with('media')
                ->orderBy('created_at','DESC')
                ->paginate(15);

        }
    }

    public function show($id)
    {

        return Gallery::with('media','cause.media')->findorfail($id);

    }

    public function create(array  $data)
    {

        $gallery                   = new Gallery();
        $gallery->id               = $data['id'];
        $gallery->cause_id         = $data['cause_id'];
        $gallery->name             = $data['name'];
        $gallery->slug             = $data['slug'];
        $gallery->details          = $data['details'];
        $gallery->status           = $data['status'];
        $gallery->save();
        return $gallery;
    }

    public function update(array $data, $id)
    {

        $gallery                   = Gallery::with('media','cause.media')->findorfail($id);
        $gallery->cause_id         = $data['cause_id'];
        $gallery->name             = $data['name'];
        $gallery->slug             = $data['slug'];
        $gallery->details          = $data['details'];
        $gallery->status           = $data['status'];
        $gallery->save();
        return $gallery;
    }

    public function delete($id)
    {

        $gallery                   = Gallery::with('media','cause.media')->findorfail($id);

        if (count($gallery->media) > 0){
            foreach ($gallery->media as $aFile)
            {
                $fileName         = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/gallery/'.$fileName);
                $aFile->delete();
            }
        }
        return $gallery->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $gallery                  = Gallery::with('media','cause.media')->findorfail($id);
        $gallery->status          = $data['status'];
        $gallery->save();
        return $gallery;
    }

    public function checkGalleryName(array $data)
    {

        $gallery                   = Gallery::where('name',$data['name'])->get();
        return $gallery;
    }
}
