<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "city";

    protected $fillable = ["name", "country_id"];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
