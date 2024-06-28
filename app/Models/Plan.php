<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';
    protected $primaryKey = 'plan_id';

    protected $fillable = [
        'plan_type',
        'plan_name',
        'amount',
        'plan_description',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'plan_id', 'plan_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'plan_id', 'plan_id');
    }
}