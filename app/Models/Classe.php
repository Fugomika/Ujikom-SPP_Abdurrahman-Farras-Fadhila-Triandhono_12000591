<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory,HasUlids;

    protected $table = 'classes';
    protected $keyType = 'string';
    protected $guarded = ['created_at','updated_at'];
    public $incrementing = false;
}
