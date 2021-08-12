<?php


namespace App\Repositories;


use App\Models\About;

class AboutRepository
{
    public function listing($request)
    {

        return About::with('media')->orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return About::with('media')->findorfail($id);

    }

    public function create(array  $data)
    {

        $about                      = new About;
        $about->id                  = $data['id'];
        $about->name                = $data['name'];
        $about->slug                = $data['slug'];
        $about->details             = $data['details'];
        $about->status              = $data['status'];
        $about->save();
        return $about;
    }


    public function update(array $data, $id)
    {

        $about                      = About::with('media')->findorfail($id);
        $about->name                = $data['name'];
        $about->slug                = $data['slug'];
        $about->details             = $data['details'];
        $about->status              = $data['status'];
        $about->save();
        return $about;
    }

    public function delete($id)
    {

        $about                      = About::with('media')->findorfail($id);

        if (count($about->media) > 0){
            foreach ($about->media as $aFile)
            {
                $fileName           = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/about/'.$fileName);
                $aFile->delete();
            }
        }
        return $about->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $about                      = About::with('media')->findorfail($id);
        $about->status              = $data['status'];
        $about->save();
        return $about;
    }

    public function checkAboutName(array $data)
    {

        $about                      = About::where('name',$data['name'])->get();
        return $about;
    }
}
