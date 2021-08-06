<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id', 'client_id', 'total', 'status'
    ];
    public function client()
   {
    return $this->belongsTo(Client::class);
   }
   public function payment()
   {
    return $this->belongsTo(Payment::class);
   }
}
