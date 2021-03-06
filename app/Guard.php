<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
	public function events()
    {
        return $this->belongsToMany('\App\Event');
    }
    public function users()
    {
        return $this->belongsToMany('\App\User');
    }
    public function urequests()
	{
		return $this->belongsToMany('App\Urequest');
	}
}
