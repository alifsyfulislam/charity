<?php


namespace App\Repositories;


use App\Models\Slider;

class SliderRepository
{

    public function listing($request)
    {
        if ($request->filled('isVisitor')){
            return Slider::with('media','cause.media')
                ->where('status','=',1)
                ->orderBy('created_at','DESC')->take(5)->get();
        }else{
            return Slider::with('media','cause.media')
                ->orderBy('created_at','DESC')
                ->paginate(15);
        }

    }

    public function show($id)
    {

        return Slider::with('media','cause.media')->findorfail($id);

    }

    public function create(array  $data)
    {

        $slider                     = new Slider;
        $slider->id                 = $data['id'];
        $slider->cause_id           = $data['cause_id'];
        $slider->name               = $data['name'];
        $slider->slug               = $data['slug'];
        $slider->details            = $data['details'];
        $slider->status             = $data['status'];
        $slider->save();
        return $slider;
    }

    public function update(array $data, $id)
    {

        $slider                     = Slider::with('media','cause.media')->findorfail($id);
        $slider->cause_id           = $data['cause_id'];
        $slider->name               = $data['name'];
        $slider->slug               = $data['slug'];
        $slider->details            = $data['details'];
        $slider->status             = $data['status'];
        $slider->save();
        return $slider;
    }

    public function delete($id)
    {

        $slider = Slider::with('media', 'cause.media')->findorfail($id);
        if (count($slider->media) > 0){
            foreach ($slider->media as $aFile)
            {
                $fileName         = basename(parse_url($aFile->url, PHP_URL_PATH));
                unlink('uploads/slider/'.$fileName);
                $aFile->delete();
            }
        }
        $slider->delete();
    }


    public function changeItemStatus(array $data, $id)
    {

        $slider                    = Slider::with('media','cause.media')->findorfail($id);
        $slider->status            = $data['status'];
        $slider->save();
        return $slider;
    }


    public function checkSliderName(array $data)
    {

        $slider                  = Slider::where('name',$data['name'])->get();
        return $slider;
    }
}
