<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_time','transaction_status','transaction_id','status_message','status_code','signature_key','payment_type','order_id','gross_amount','approval_code'];
}
