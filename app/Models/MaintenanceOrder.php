<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceOrder extends Model
{
    protected $fillable = [
        'order_number',
        'machine_id',
        'maintenance_type',
        'status',
        'technician',
        'estimated_cost',
        'actual_cost',
        'completed_at',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
