<?php

namespace App\Http\Controllers;

use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Http\Request;

class UbiGeoController extends Controller
{
    public function getRegionProvincias($region_id)
    {
        
        return Provincia::where('region_id', $region_id)->get();
    }

    public function getProvinciaDistritos($provincia_id)
    {
        return Distrito::where('provincia_id',$provincia_id)->get();
    }
   
}
