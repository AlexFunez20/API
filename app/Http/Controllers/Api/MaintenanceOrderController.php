<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceOrder;

class MaintenanceOrderController extends Controller
{
    /*Consulta 4. Órdenes de mantenimiento sin fecha de finalización 2%*/

    public function sinFinalizar()
    {
        $orders = MaintenanceOrder::select(
                'id',
                'order_number',
                'maintenance_type',
                'status',
                'technician',
                'estimated_cost'
            )
            ->whereNull('completed_at')
            ->get();

        return response()->json($orders);
    }

    /*Consulta 5. Órdenes de mantenimiento con costo real registrado 2%*/

    public function conCostoReal()
    {
        $orders = MaintenanceOrder::select(
                'id',
                'order_number',
                'machine_id',
                'estimated_cost',
                'actual_cost'
            )
            ->whereNotNull('actual_cost')
            ->where('status', 'finalizado')
            ->get();

        return response()->json($orders);
    }
}