<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class AddressController extends Controller
{
    public function getProvince()
    {
        $listProvince = Province::orderBy('priority')->get()->toArray();

        return $listProvince;
    }

    public function getDistrict($provinceID)
    {
        $listDistrict = District::where('province_id', $provinceID)->get()->toArray();

        return $listDistrict;
    }

    public function getWard($districtID)
    {
        $listWard = Ward::where('district_id', $districtID)->get()->toArray();

        return $listWard;
    }
}
