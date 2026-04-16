<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product'; // your table name

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'product_name',
        'image'
    ];

    public $timestamps = true;
}
