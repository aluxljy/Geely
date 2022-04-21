<?php
namespace App\Http\Controllers;
use App\Models\Collection;
use App\Models\UsedCar;
use App\Models\Inspection;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;


use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    //
    public function viewPage(Request $Request){


        $checked = $Request->checkedbox;

        $CollectionID = collect($checked);

        $collection = Collection::findMany($CollectionID);

        $usedcar1 = UsedCar::find($collection[0]->used_car_id);
        $usedcar2 = UsedCar::find($collection[1]->used_car_id);

        // Data1
        $Inspection1 = Inspection::select('result_file')->where('used_car_id',$usedcar1->id)->latest()->first();
        $File2 = public_path($Inspection1->result_file);

        $reader = new ReaderXlsx();
        $spreadsheet1 = $reader->load($File2);
        $sheet1 = $spreadsheet1->getActiveSheet();

        $worksheetInfo = $reader->listWorksheetInfo($File2);
        $Data1 = $sheet1->toArray();

        // Data1
        $Inspection2 = Inspection::select('result_file')->where('used_car_id',$usedcar2->id)->latest()->first();
        $File2 = public_path($Inspection2->result_file);

        $reader = new ReaderXlsx();
        $spreadsheet2 = $reader->load($File2);
        $sheet2 = $spreadsheet2->getActiveSheet();

        $worksheetInfo = $reader->listWorksheetInfo($File2);
        $Data2 = $sheet2->toArray();

        // dd($usedcar2);

        return view('Comparison',
        ['collections'=> $collection,'usedcar1' => $usedcar1,'usedcar2' => $usedcar2, 'Data1' =>$Data1, 'Data2' => $Data2]);

    }
}
