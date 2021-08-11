<?php


namespace App\Repositories;


use App\Models\Contact;

class ContactRepository
{
    public function listing($request)
    {

        return Contact::orderBy('created_at','DESC')->paginate(15);

    }


    public function show($id)
    {

        return Contact::findorfail($id);

    }


    public function create(array  $data)
    {

        $contact                    = new Contact;
        $contact->subject           = $data['subject'];
        $contact->email             = $data['email'];
        $contact->body              = $data['body'];
        $contact->status            = $data['status'];
        $contact->save();
        return $contact;
    }

    public function update(array $data, $id)
    {

        $contact                    = Contact::findorfail($id);
        $contact->subject           = $data['subject'];
        $contact->email             = $data['email'];
        $contact->body              = $data['body'];
        $contact->status            = $data['status'];
        $contact->save();
        return $contact;
    }

    public function delete($id)
    {

        $contact                    = Contact::findorfail($id);
        return $contact->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $contact                    = Contact::findorfail($id);
        $contact->status            = $data['status'];
        $contact->save();
        return $contact;
    }
}