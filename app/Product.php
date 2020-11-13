<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Utils\CanBeRate;

class Product extends Model
{
    use CanBeRate;

    protected $fillable = ['name', 'price'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User');
    }
}
