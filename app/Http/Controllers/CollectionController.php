<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $collections = DB::table('car_models')
        //         ->join('car_variants', 'car_variants.car_model_id', '=', 'car_models.id')
        //         ->join('used_cars', 'used_cars.car_variant_id', '=', 'car_variants.id')
        //         ->join('catalogues', 'catalogues.used_car_id', '=', 'used_cars.id')
        //         ->join('collections', 'collections.catalogue_id', '=', 'catalogues.id')
        //         ->where('collections.user_id', '=', auth()->id())
        //         ->get();
        
        $collections = DB::table('used_cars')
                ->join('cars', 'used_cars.car_id', '=', 'cars.id')
                ->join('car_variants', 'cars.car_variant_id', '=', 'car_variants.id')
                ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')
                ->join('collections', 'collections.used_car_id', '=', 'used_cars.id')  
                ->where('collections.user_id', '=', auth()->id())
                ->get();
       
        return view('Collection2', ['collections' => $collections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection = new Collection();
        $collection->used_car_id = $request->input("usedcar_id");
        $collection->user_id = auth()->id();
        $collection->save();

        return redirect()->route('catalogue.viewpage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $collection = Collection::findOrFail($id);
        $collection->delete();

        return redirect()->route('collection.index');
    }


}
