<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'status',
        'criticality',
        'production_line_id',
    ];

    public function productionLine()
    {
        return $this->belongsTo(ProductionLine::class);
    }

    public function maintenanceOrders()
    {
        return $this->hasMany(MaintenanceOrder::class);
    }
}
