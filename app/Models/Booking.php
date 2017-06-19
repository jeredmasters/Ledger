<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $dates = ['from','to'];
    protected $table = 'bookings';

    public static function bookings($date){
        $bookings = Booking::active()->where('from','<=',$date)->where('to', '>=', $date)->get();
        return $bookings;
    }
    public static function active(){
        return Booking::where('active','=',true);
    }
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
    public static function newBooking(){
        $name = 'booking name';
        $user = session('user', null);
        if ($user !== null){
            $name = $user->name;
        }
        return (object)[
            'id' => null,
            'name' => explode(' ',$name)[0],
            'type' => 2,
            'from' => new \DateTime,
            'to' => new \DateTime,
            'main' => true,
            'flat' => false,
            'studio' => false
        ];
    }
    public function toEvents(){
        $events = [];
        if ($this->main){
            $events[] = [
                'id' => $this->id,
                'title' => $this->name . ' - Main', //event title
                'allDay' => true, //full day event?
                'start' => $this->from->format('Y-m-d'), //start time (you can also use Carbon instead of DateTime)
                'end' => $this->to->format('Y-m-d'), //end time (you can also use Carbon instead of DateTime)
                'color' => config('areas.main.color'),
                'area' => 'main',
                'type' => $this->type
            ];
        }
        if ($this->flat){
            $events[] = [
                'id' => $this->id,
                'title' => $this->name . ' - Flat', //event title
                'allDay' => true, //full day event?
                'start' => $this->from->format('Y-m-d'), //start time (you can also use Carbon instead of DateTime)
                'end' => $this->to->format('Y-m-d'), //end time (you can also use Carbon instead of DateTime)
                'color' => config('areas.flat.color'),
                'area' => 'flat',
                'type' => $this->type
            ];
        }
        if ($this->studio){
            $events[] = [
                'id' => $this->id,
                'title' => $this->name . ' - Studio', //event title
                'allDay' => true, //full day event?
                'start' => $this->from->format('Y-m-d'), //start time (you can also use Carbon instead of DateTime)
                'end' => $this->to->format('Y-m-d'), //end time (you can also use Carbon instead of DateTime)
                'color' => config('areas.studio.color'),
                'area' => 'studio',
                'type' => $this->type
            ];
        }
        return $events;
    }
}
