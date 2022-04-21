<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Collection;
use App\Models\Newsletter;
use App\Models\UsedCar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //
    public function viewPage(){

        $Dash = Newsletter::orderby('ID','DESC')->get();

        $usedcar = UsedCar::all()->where('status','1')->take(3);

        $collections = Collection::all()->where('user_id',auth()->id());

        return view('Dashboard', 
        ['Dash' => $Dash,],['usedcar' => $usedcar,],['collections'=> $collections]);

    }
}
