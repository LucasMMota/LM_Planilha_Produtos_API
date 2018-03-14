<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['lm', 'name', 'free_shipping', 'description', 'price'];

    public $primaryKey = 'lm';

}
