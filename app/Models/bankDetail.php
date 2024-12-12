<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankDetail extends Model
{
    use HasFactory;



    protected $table = 'bankDetails';


    protected $fillable = [
        'userid',
        'bank_name',
        'bank_acc',
        'bank_branch',
        'bank_ifsc',
        'bank_holder',
        'upi'
    ];
}
