<?php


namespace App\Repositories;


use App\Models\Gallery;

class GalleryRepository
{
    public function listing($request)
    {

        return Gallery::with('media')->orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return Gallery::with('media')->findorfail($id);

    }

    public function create(array  $data)
    {

        $gallery                   = new Gallery();
        $gallery->id               = $data['id'];
        $gallery->event_id         = $data['event_id'];
        $gallery->name             = $data['name'];
        $gallery->slug             = $data['slug'];
        $gallery->details          = $data['details'];
        $gallery->status           = $data['status'];
        $gallery->save();
        return $gallery;
    }

    public function update(array $data, $id)
    {

        $gallery                   = Gallery::with('media')->findorfail($id);
        $gallery->event_id         = $data['event_id'];
        $gallery->name             = $data['name'];
        $gallery->slug             = $data['slug'];
        $gallery->details          = $data['details'];
        $gallery->status           = $data['status'];
        $gallery->save();
        return $gallery;
    }

    public function delete($id)
    {

        $gallery                   = Gallery::with('media')->findorfail($id);

        if (isset($gallery->media)){
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

        $gallery                  = Gallery::with('media')->findorfail($id);
        $gallery->status          = $data['status'];
        $gallery->save();
        return $gallery;
    }
}