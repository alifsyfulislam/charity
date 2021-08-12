<?php


namespace App\Repositories;


use App\Models\Event;

class EventRepository
{
    protected $causeRepository;
    protected $galleryRepository;

    public function __construct(CauseRepository $causeRepository, GalleryRepository $galleryRepository)
    {

        $this->causeRepository    = $causeRepository;
        $this->galleryRepository  = $galleryRepository;

    }
    public function listing($request)
    {

        return Event::with('media','causes.media','galleries.media','contents')->orderBy('created_at','DESC')->paginate(15);

    }

    public function show($id)
    {

        return Event::with('media','causes.media','galleries.media','contents')->findorfail($id);

    }

    public function create(array  $data)
    {

        $event                     = new Event();
        $event->id                 = $data['id'];
        $event->name               = $data['name'];
        $event->location           = $data['location'];
        $event->slug               = $data['slug'];
        $event->details            = $data['details'];
        $event->status             = $data['status'];
        $event->save();
        return $event;
    }

    public function update(array $data, $id)
    {

        $event                    = Event::with('media','causes.media','galleries.media','contents')->findorfail($id);
        $event->name              = $data['name'];
        $event->location          = $data['location'];
        $event->slug              = $data['slug'];
        $event->details           = $data['details'];
        $event->status            = $data['status'];

        //as well as all cause status will be changed
        if (count($event->causes) > 0){
            foreach ($event->causes as $aCause){
                $this->causeRepository->changeItemStatus($data, $aCause->id);
            }
        }

        //as well as all gallery status will be changed
        if (count($event->galleries) > 0){
            foreach ($event->galleries as $aGallery){
                $this->galleryRepository->changeItemStatus($data, $aGallery->id);
            }
        }

        $event->save();
        return $event;
    }

    public function delete($id)
    {

        $event                    = Event::with('media','causes.media','galleries.media','contents')->findorfail($id);

        //cause delete
        if (count($event->causes) > 0){
            foreach ($event->causes as $aCause){
                $this->causeRepository->delete($aCause->id);
            }
        }

        //gallery delete
        if (count($event->galleries) > 0){
            foreach ($event->galleries as $aGallery){
                $this->galleryRepository->delete($aGallery->id);
            }
        }

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

        $event                    = Event::with('media','causes.media','galleries.media','contents')->findorfail($id);
        $event->status            = $data['status'];

        //as well as all cause status will be changed
        if (count($event->causes) > 0){
            foreach ($event->causes as $aCause){
                $this->causeRepository->changeItemStatus($data, $aCause->id);
            }
        }

        //as well as all gallery status will be changed
        if (count($event->galleries) > 0){
            foreach ($event->galleries as $aGallery){
                $this->galleryRepository->changeItemStatus($data, $aGallery->id);
            }
        }

        $event->save();
        return $event;
    }


    public function checkEventName(array $data)
    {

        $event                  = Event::where('name',$data['name'])->get();
        return $event;
    }
}
