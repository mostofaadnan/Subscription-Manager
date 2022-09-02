<?php

namespace App\Models\ClientModule;

use App\Models\MemberShip\MebserShip;
use App\Models\SubscriptionPlan\SubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'bill_address',
        'mfee_id',
        'client_status',
        'subplan_id',
        'bill_startdate',
    ];

    /**
     * Relation with
     * 
     * mebser_ships Table (MebserShip class Model)
     * 
     * where
     * 
     * subplan_id is foreign key wich is in client table
     * 
     * and 
     * id is primary key whcih is in mebser_ships table
     */
    public function mebser_ships()
    {
        return $this->belongsTo(MebserShip::class, 'membership_id', 'id');
    }

       /**
     * Relation with
     * 
     * subscription_plans Table (SubscriptionPlan class Model)
     * 
     * where
     * 
     * mfee_id is foreign key wich is in client table
     * 
     * and 
     * id is primary key whcih is in subscription_plans table
     */
    public function subscription_plans()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_id', 'id');
    }

}
