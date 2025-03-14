<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['user_id', 'order_number', 'transaction_id', 'amount', 'is_payment'];
}
