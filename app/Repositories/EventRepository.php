<?php


namespace App\Repositories;


use App\Models\Event;

class EventRepository
{
    public function listing($request)
    {
        if ($request->filled('isVisitor')){
            return Event::with('media')
                ->orderBy('created_at','DESC')
                ->take(3)->get();
        }elseif ($request->filled('isPaginate')){
            return Event::with('media')
                ->orderBy('created_at','DESC')
                ->paginate(3);
        }
        else{
            return Event::with('media','contents')
                ->orderBy('created_at','DESC')
                ->paginate(15);
        }

    }

    public function show($id)
    {

        return Event::with('media','contents')->findorfail($id);

    }

    public function create(array  $data)
    {

        $event                     = new Event();
        $event->id                 = $data['id'];
        $event->name               = $data['name'];
        $event->location           = $data['location'];
        $event->slug               = $data['slug'];
        $event->details            = $data['details'];
        $event->start_date         = $data['start_date'];
        $event->end_date           = $data['end_date'];
        $event->status             = $data['status'];
        $event->save();
        return $event;
    }

    public function update(array $data, $id)
    {

        $event                     = Event::with('media','contents')->findorfail($id);
        $event->name               = $data['name'];
        $event->location           = $data['location'];
        $event->slug               = $data['slug'];
        $event->details            = $data['details'];
        $event->start_date         = $data['start_date'];
        $event->end_date           = $data['end_date'];
        $event->status             = $data['status'];
        $event->save();
        return $event;
    }

    public function delete($id)
    {

        $event                    = Event::with('media','contents')->findorfail($id);

        //event media delete
        if (count($event->media) > 0){
            foreach ($event->media as $aFile)
            {
                $fileName         = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/event/'.$fileName);
                $aFile->delete();
            }
        }
        return $event->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $event                    = Event::with('media','contents')->findorfail($id);
        $event->status            = $data['status'];
        $event->save();
        return $event;
    }


    public function checkEventName(array $data)
    {

        $event                  = Event::where('name',$data['name'])->get();
        return $event;
    }
}
