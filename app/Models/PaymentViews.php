<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentViews extends Model
{
    use HasFactory,HasUlids;

    protected $table = 'payment_views';
    protected $keyType = 'string';
}
