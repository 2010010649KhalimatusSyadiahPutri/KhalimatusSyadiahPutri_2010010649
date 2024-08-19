<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class LokasiController extends Controller
{

    public function index()
    {
        return view('location.index', [
            'title' => 'Daftar Wilayah Indonesia'
        ]);
    }

    /*
     * @param wilayah[cities][province_code]=11&wilayah[districts][city_code]=1101&wilayah[villages][district_code]=110101
     */
    public function ajax(Request $request)
    {
        $provinces  = Province::get();
        $cities     = null;
        $districts  = null;
        $villages   = null;

        $rows = count($provinces);

        foreach ($request->all() as $wilayah) {

            if (($wilayah['cities'] ??  false)) {
                $cities     = City::select();

                foreach (($wilayah['cities']) as $key => $value) {
                    // province_code
                    $cities->where($key, $value);
                }

                $cities     = $cities->get();

                $rows = $rows < $cities->count() ? $cities->count() : $rows;
            }

            if ($wilayah['districts'] ?? false) {
                $districts  = District::select();

                foreach (($wilayah['districts']) as $key => $value) {
                    // city_code
                    $districts->where($key, $value);
                }

                $districts  = $districts->get();

                $rows = $rows < $districts->count() ? $districts->count() : $rows;
            }

            if ($wilayah['villages'] ?? false) {
                $villages   = Village::select();

                foreach (($wilayah['villages']) as $key => $value) {
                    // village_code
                    $villages->where($key, $value);
                }

                $villages   = $villages->get();

                $rows = $rows < $villages->count() ? $villages->count() : $rows;
            }

        }

        for ($i = 0; $i < $rows; $i++) {
            $results['table'][$i] = [
                'province'  => $provinces[$i] ?? null,
                'city'      => $cities[$i] ?? null,
                'district'  => $districts[$i] ?? null,
                'village'   => $villages[$i] ?? null,
            ];
        }

        return response()->json($results ?? []);
    }
}
