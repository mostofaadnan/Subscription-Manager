<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientModule\Client;
class clientInvoice extends Model
{
    use HasFactory;
    public function clinet_Info()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
