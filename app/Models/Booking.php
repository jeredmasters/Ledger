<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $dates = ['from','to'];
    protected $table = 'bookings';

    public function areas(){
        $areas = [];
        if ($this->main){
            $areas[] = 'M';
        }
        if ($this->flat){
            $areas[] = 'F';
        }
        if ($this->studio){
            $areas[] = 'S';
        }
        return join(',',$areas);
    }
    public function toEvents(){
        $events = [];
        if ($this->main){
            $events[] = [
                'id' => $this->id,
                'title' => $this->name, //event title
                'allDay' => true, //full day event?
                'start' => $this->from->format('Y-m-d'), //start time (you can also use Carbon instead of DateTime)
                'end' => $this->to->format('Y-m-d'), //end time (you can also use Carbon instead of DateTime)
                'color' => config('areas.main.color'),
                'main' => $this->main == "1",
                'flat' => $this->flat == "1",
                'studio' => $this->studio == "1"
            ];
        }
        if ($this->flat){
            $events[] = [
                'id' => $this->id,
                'title' => $this->name, //event title
                'allDay' => true, //full day event?
                'start' => $this->from->format('Y-m-d'), //start time (you can also use Carbon instead of DateTime)
                'end' => $this->to->format('Y-m-d'), //end time (you can also use Carbon instead of DateTime)
                'color' => config('areas.flat.color'),
                'main' => $this->main == "1",
                'flat' => $this->flat == "1",
                'studio' => $this->studio == "1"
            ];
        }
        if ($this->studio){
            $events[] = [
                'id' => $this->id,
                'title' => $this->name, //event title
                'allDay' => true, //full day event?
                'start' => $this->from->format('Y-m-d'), //start time (you can also use Carbon instead of DateTime)
                'end' => $this->to->format('Y-m-d'), //end time (you can also use Carbon instead of DateTime)
                'color' => config('areas.studio.color'),
                'main' => $this->main == "1",
                'flat' => $this->flat == "1",
                'studio' => $this->studio == "1"
            ];
        }
        return $events;
    }
}
