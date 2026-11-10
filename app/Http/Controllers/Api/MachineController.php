<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Machine;

class MachineController extends Controller
{
        /*Consulta 1. Máquinas operativas de una línea de producción 2%*/

    public function operativasPorLinea($lineId = 1)
    {
        $machines = Machine::select('id', 'code', 'name', 'type', 'status', 'criticality')
            ->where('production_line_id', $lineId)
            ->where(function ($query) {
                $query->where('status', 'operativa')
                      ->orWhere('status', 'mantenimiento');
            })
            ->get();

        return response()->json($machines);
    }

    /*Consulta 2. Máquinas según su nivel de criticidad 2%*/
    public function porCriticidad()
    {
        $machines = Machine::select('id', 'code', 'name', 'type', 'status', 'criticality')
            ->whereIn('criticality', ['alta', 'media'])
            ->get();

        return response()->json($machines);
    }
    // Consulta 3: máquinas disponibles (no fuera de servicio ni en mantenimiento)
    public function disponibles()
    {
        $machines = Machine::select('id', 'code', 'name', 'type', 'status', 'criticality')
            ->whereNotIn('status', ['fuera_servicio', 'mantenimiento'])
            ->get();

        return response()->json($machines);
    }

    /*Consulta 6. Máquinas que tienen órdenes pendientes 2%*/

    public function conOrdenesPendientes()
    {
        $machines = Machine::select('id', 'code', 'name', 'type', 'status', 'criticality')
            ->whereHas('maintenanceOrders', function ($query) {
                $query->where('status', 'pendiente');
            })
            ->get();

        return response()->json($machines);
    }

    

    /*Consulta 7. Máquinas que tienen mantenimiento correctivo 2%*/
    public function conCorrectivo()
    {
        $machines = Machine::select('id', 'code', 'name', 'type', 'status', 'criticality')
            ->whereHas('maintenanceOrders', function ($query) {
                $query->where('maintenance_type', 'correctivo')
                      ->where('status', 'finalizado');
            })
            ->get();

        return response()->json($machines);
    }

    /*Consulta 8. Máquinas que nunca han tenido órdenes de mantenimiento*/

    public function sinOrdenes()
    {
        $machines = Machine::select('id', 'code', 'name', 'type', 'status', 'criticality')
            ->doesntHave('maintenanceOrders')
            ->get();

        return response()->json($machines);
    }

    /*Consulta 9. Tipos de máquinas registrados en la planta 2%.*/

    public function tiposDeMaquinas()
    {
        $tipos = Machine::select('type')
            ->distinct()
            ->get();

        return response()->json($tipos);
    }

    /*Consulta 10. Máquinas de líneas de producción activas que tienen órdenes
      pendientes 2%*/
    public function maquinasActivasConOrdenesPendientes()
    {
        $machines = Machine::select('id', 'code', 'name', 'status', 'criticality')
            ->whereHas('productionLine', function ($query) {
                $query->where('status', 'activa');
            })
            ->whereHas('maintenanceOrders', function ($query) {
                $query->where('status', 'pendiente');
            })
            ->get();

        return response()->json($machines);
    }
}