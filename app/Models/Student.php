<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory,HasUlids;

    protected $table = 'students';
    protected $keyType = 'string';
    protected $primaryKey = 'nisn';
    protected $guarded = ['created_at','updated_at'];
    public $incrementing = false;
}
