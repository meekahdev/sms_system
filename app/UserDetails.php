<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';
    
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'address', 'city', 'zipcode', 'phone_no', 'dob',  'salary'
    ];
}
