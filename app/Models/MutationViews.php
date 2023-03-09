<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationViews extends Model
{
    use HasFactory,HasUlids;

    protected $table = 'mutation_views';
    protected $keyType = 'string';
}
