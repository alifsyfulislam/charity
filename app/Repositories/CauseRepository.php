<?php


namespace App\Repositories;


use App\Models\Cause;

class CauseRepository
{
    protected $sliderRepository;
    protected $galleryRepository;

    public function __construct(SliderRepository $sliderRepository, GalleryRepository $galleryRepository)
    {

        $this->sliderRepository      = $sliderRepository;
        $this->galleryRepository     = $galleryRepository;

    }

    public function listing($request)
    {

        if ($request->filled('isVisitor')){
            return Cause::with('media')
                ->where('status','=',1)
                ->orderBy('created_at','DESC')
                ->take(5)
                ->get();
        }else if ($request->filled('isSuggestion')){
            return Cause::where('status','=',1)
                ->orderBy('created_at','DESC')->get(['id', 'name']);
        }
        else if ($request->filled('isPaginate')){
            return Cause::with('media')
                ->where('status','=',1)
                ->orderBy('created_at','DESC')
                ->paginate(6);
        }
        else if ($request->filled('isFeatured')){
            return Cause::with('media')
                ->where('status','=',1)
                ->where('featured_status','=',1)
                ->orderBy('created_at','DESC')
                ->take(2)
                ->get();
        }
        else{
            return Cause::with('media','contents','slider.media','galleries.media')
                ->orderBy('created_at','DESC')
                ->paginate(15);

        }
    }

    public function show($id)
    {

        return Cause::with('media','contents','slider.media','galleries.media')->findorfail($id);

    }

    public function create(array  $data)
    {

        $cause                     = new Cause();
        $cause->id                 = $data['id'];
//        $cause->event_id           = $data['event_id'];
        $cause->name               = $data['name'];
        $cause->slug               = $data['slug'];
        $cause->details            = $data['details'];
        $cause->target_fund        = $data['target_fund'];
        $cause->raised_fund        = $data['raised_fund'];
        $cause->status             = $data['status'];
        $cause->start_date         = $data['start_date'];
        $cause->end_date           = $data['end_date'];
        $cause->status             = $data['status'];
        $cause->featured_status    = $data['featured_status'];
        $cause->save();
        return $cause;
    }

    public function update(array $data, $id)
    {

        $cause                     = Cause::with('media','contents','slider.media','galleries.media')->findorfail($id);
//        $cause->event_id          = $data['event_id'];
        $cause->name               = $data['name'];
        $cause->slug               = $data['slug'];
        $cause->details            = $data['details'];
        $cause->target_fund        = $data['target_fund'];
        if ($cause->raise_fund+$data['raised_fund'] <= $data['target_fund']){
            $cause->raised_fund        += $data['raised_fund'];
        }
        $cause->start_date         = $data['start_date'];
        $cause->end_date           = $data['end_date'];
        $cause->status             = $data['status'];
        $cause->featured_status    = $data['featured_status'];
        if (isset($cause->slider)){
            $this->sliderRepository->changeItemStatus($data, $cause->slider->id);
        }
        //as well as all gallery status will be changed
        if (count($cause->galleries) > 0){
            foreach ($cause->galleries as $aGallery){
                $this->galleryRepository->changeItemStatus($data, $aGallery->id);
            }
        }
        $cause->save();
        return $cause;
    }


    public function delete($id)
    {

        $cause                     = Cause::with('media','contents','slider.media','galleries.media')->findorfail($id);

        if (count($cause->media) > 0){
            foreach ($cause->media as $aFile)
            {
                $fileName          = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/cause/'.$fileName);
                $aFile->delete();
            }
        }
        if (isset($cause->slider)){
            $this->sliderRepository->delete($cause->slider->id);
        }
        //gallery delete
        if (count($cause->galleries) > 0){
            foreach ($cause->galleries as $aGallery){
                $this->galleryRepository->delete($aGallery->id);
            }
        }
        return $cause->delete();
    }

    public function changeItemStatus(array $data, $id)
    {

        $cause                     = Cause::with('media','contents','slider.media','galleries.media')->findorfail($id);
        $cause->status             = $data['status'];
        if (isset($cause->slider)){
            $this->sliderRepository->changeItemStatus($data, $cause->slider->id);
        }
        //as well as all gallery status will be changed
        if (count($cause->galleries) > 0){
            foreach ($cause->galleries as $aGallery){
                $this->galleryRepository->changeItemStatus($data, $aGallery->id);
            }
        }
        $cause->save();
        return $cause;
    }

    public function checkCauseName(array $data)
    {

        $cause                     = Cause::where('name',$data['name'])->get();
        return $cause;
    }

    public function getCauseDetails($slug)
    {

        return Cause::with('media','contents')
            ->where('slug','=',$slug)
            ->first();

    }
}
