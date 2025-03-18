<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['user_id', 'order_number', 'transaction_id', 'amount', 'is_payment'];

    static function getData($user_id) {
        return self::select('transactions.*', 'users.name')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->where('transactions.user_id', '=', $user_id)
            ->orderBy('transactions.id', 'desc')
            ->paginate(10);
    }
}
