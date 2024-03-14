<?php
namespace App\Services;

use App\Models\Area;

class DashboardService
{
    public function getCountPatient()
    {
        $areas = Area::withCount('patientsAreas')->get();

        $pacientesXarea = [];

        foreach ($areas as $area) {
            $pacientesXarea[$area->area] = $area->patientsAreas->count();
        }
        return json_encode($pacientesXarea);
    }


}
