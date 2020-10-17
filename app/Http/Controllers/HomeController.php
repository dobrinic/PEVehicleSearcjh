<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('parts')->paginate(12);

        $brands = DB::table('vehicles')->distinct()->select('bike_producer')->get();
        $years = DB::table('vehicles')->distinct()->select('year')->get();
        $sizes = DB::table('vehicles')->distinct()->select('size')->whereNotNull('size')->orderBy('size')->get();

        return view('home', compact('vehicles', 'brands', 'years', 'sizes'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {

            $query = Vehicle::select('*');
            $selectedFilters = [];

            foreach ($request->all() as $key => $value) {
                if($value){
                    $query->where($key, $value);
                    array_push($selectedFilters, $value);
                }
            }

            $selectors = $query->get();

            $vehicles2 = $query->simplePaginate(12);
            $vehicles2->withPath('/');

            // dd($vehicles);

            $html = view('chunks.search-results', compact('vehicles2'))->render();

            return response()->json( compact('selectors', 'html', 'selectedFilters'));
        }
    }
}
