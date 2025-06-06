<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name', 'governorate_id');

    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function donation_requests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    // Override the delete method
    public function delete()
    {
        $this->clients()->update(['city_id' => null]);
        $this->donation_requests()->update(['city_id' => null]);
        return parent::delete();
    }
}
