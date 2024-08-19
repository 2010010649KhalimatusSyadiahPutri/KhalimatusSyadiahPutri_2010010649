<?php

namespace App\Http\Controllers\Babinsa;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->position_id != 2) {
            return abort(403, 'anda bukan babinsa');
        }

        return view('dashboard_babinsa', [
            'title' => 'Dashboard babinsa'
        ]);
    }
}
