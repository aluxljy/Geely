<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;

use App\Models\UsedCar;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\CarVariant;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isInfinite;

class CatalogueController extends Controller
{
    public function viewPage(){

        $usedcar = UsedCar::all()->where('status','1');

        return view('Catalogue',
        ['usedcar' => $usedcar,]
    );

    }

    public function viewAdminPage(){

        return view('ManageCatalogue');
    }

    public function search(){
        $usedcar = UsedCar::
        select('used_cars.*')
        ->join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','cars.car_model_id','=','car_models.id')
        ->where('car_models.model','LIKE', '%'.request('query').'%')
        ->where('status','1')
        ->get();
    
        return view('Catalogue',['usedcar'=>$usedcar,]);

    }

    public function advanced(){
        $year = request('year');
        $minPrice = request('minPrice');
        $maxPrice = request('maxPrice');

        if($year==null){
            $year=0;
        }

        if($minPrice==null){
            $minPrice=0;
        }

        if($maxPrice==null){
            $maxPrice=UsedCar::max('max_price');
        }
        
        $usedcar = UsedCar::
        select('used_cars.*')
        ->join('cars','cars.id','=','used_cars.car_id')
        ->select('*','used_cars.id AS id')
        ->join('car_models','cars.car_model_id','=','car_models.id')
        ->where('car_models.model','LIKE', '%'.request('model').'%')
        ->where('cars.year','>=',$year)
        ->where('used_cars.min_price','>=',$minPrice)
        ->where('used_cars.max_price','<=',$maxPrice)
        ->where('status','1')
        ->get(); 
    
        return view('Catalogue',['usedcar'=>$usedcar,]);
    }
    

}
