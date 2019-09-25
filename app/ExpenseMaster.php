<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseMaster extends Model
{
    protected $table = 'expenses_master';
    
    protected $fillable = [
        'user_id', 'category_id', 'description', 'comment', 'amount', 'generated_at'
    ];
}
