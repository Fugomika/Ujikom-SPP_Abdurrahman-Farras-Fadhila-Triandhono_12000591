<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory,HasUlids;

    protected $table = 'tuitions';
    protected $keyType = 'string';
    protected $guarded = ['created_at','updated_at'];
    public $incrementing = false;
}
