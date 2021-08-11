<?php


namespace App\Repositories;


use App\Models\Faq;

class FaqRepository
{
    public function listing($request)
    {

        return Faq::orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return Faq::findorfail($id);

    }

    public function create(array  $data)
    {

        $faq                        = new Faq;
        $faq->id                    = $data['id'];
        $faq->name                  = $data['name'];
        $faq->slug                  = $data['slug'];
        $faq->details               = $data['details'];
        $faq->status                = $data['status'];
        $faq->save();
        return $faq;
    }


    public function update(array $data, $id)
    {

        $faq                        = Faq::findorfail($id);
        $faq->name                  = $data['name'];
        $faq->slug                  = $data['slug'];
        $faq->details               = $data['details'];
        $faq->status                = $data['status'];
        $faq->save();
        return $faq;
    }

    public function delete($id)
    {

        $faq                        = Faq::findorfail($id);
        return $faq->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $faq                        = Faq::findorfail($id);
        $faq->status                = $data['status'];
        $faq->save();
        return $faq;
    }
}