<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    use HasFactory,HasUlids;

    protected $table = 'special';
    protected $fillable = ['nisn_fk_id','reduction'];
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;}
