<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category_master';
    
    protected $fillable = [
        'name', 'description', 'comment', 'updated_by'
    ];
}
