<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_name',
        'card_number',
        'card_country',
        'expired_month',
        'expired_year',
        'cvc',
        'postal_code',
        'checkout_status',
        'total_price'
    ];

    public function detail() {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }
}
