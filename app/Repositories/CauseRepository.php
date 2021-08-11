<?php


namespace App\Repositories;


use App\Models\Cause;

class CauseRepository
{
    public function listing($request)
    {

        return Cause::with('media')->orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return Cause::with('media')->findorfail($id);

    }

    public function create(array  $data)
    {

        $cause                     = new Cause();
        $cause->id                 = $data['id'];
        $cause->event_id           = $data['event_id'];
        $cause->name               = $data['name'];
        $cause->slug               = $data['slug'];
        $cause->details            = $data['details'];
        $cause->target_fund        = $data['target_fund'];
        $cause->raised_fund        = $data['raised_fund'];
        $cause->status             = $data['status'];
        $cause->save();
        return $cause;
    }

    public function update(array $data, $id)
    {

        $cause                    = Cause::with('media')->findorfail($id);
        $cause->event_id          = $data['event_id'];
        $cause->name              = $data['name'];
        $cause->slug              = $data['slug'];
        $cause->details           = $data['details'];
        $cause->target_fund       = $data['target_fund'];
        $cause->raised_fund       += $data['raised_fund'];
        $cause->status            = $data['status'];
        $cause->save();
        return $cause;
    }


    public function delete($id)
    {

        $cause                    = Cause::with('media')->findorfail($id);

        if (isset($cause->media)){
            foreach ($cause->media as $aFile)
            {
                $fileName         = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/cause/'.$fileName);
                $aFile->delete();
            }
        }
        return $cause->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $cause                    = Cause::with('media')->findorfail($id);
        $cause->status            = $data['status'];
        $cause->save();
        return $cause;
    }
}