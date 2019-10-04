<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesLimit extends Model
{
    //
    protected $table = 'expenses_limit';

    protected $fillable = [
        'id', 'category_id','user_id','amount', 'from_date', 'to_date'
    ];
}
