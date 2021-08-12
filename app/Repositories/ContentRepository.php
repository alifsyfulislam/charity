<?php


namespace App\Repositories;


use App\Models\Content;

class ContentRepository
{
    public function listing($request)
    {

        return Content::orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return Content::findorfail($id);

    }

    public function create(array  $data)
    {

        $content                    = new Content;
        $content->link_id           = $data['link_id'];
        $content->content_body      = $data['content_body'];
        $content->save();
        return $content;
    }

    public function update(array $data, $id)
    {

        $content                    = Content::findorfail($id);
        $content->link_id           = $data['link_id'];
        $content->content_body      = $data['content_body'];
        $content->save();
        return $content;
    }

    public function delete($id)
    {

        $content                    = Content::findorfail($id);
        return $content->delete();
    }
}
