<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class listingModel extends Model
{
    protected $table = 'listing_table'; // your table name

    protected $fillable = ['listing']; // column name
}
