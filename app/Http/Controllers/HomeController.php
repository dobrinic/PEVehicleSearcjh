<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
                if($value && $key != 'page'){
                    $query->where($key, $value);
                    array_push($selectedFilters, $value);
                }
            }

            $selectors = $query->get();

            /* CUSTOM PAGINATION */
            $totalCount = $query->count();
            $pageNum = $request->page ?:1;

            if ($pageNum) {
                $skip = 12 * ($pageNum - 1);
                $query = $query->take(12)->skip($skip);
            } else {
                $query = $query->take(12)->skip(0);
            }

            $parameters = $request->getQueryString();
            $parameters = preg_replace('/&page(=[^&]*)?|^page(=[^&]*)?&?/','', $parameters);
            $path = url('/') . '/?' . $parameters;

            $vehicles = $query->get();

            $vehicles = new LengthAwarePaginator($vehicles, $totalCount, 12, $pageNum);
            $vehicles = $vehicles->withPath($path);

            $html = view('chunks.search-results', compact('vehicles'))->render();

            return response()->json( compact('selectors', 'html', 'selectedFilters'));
        }
    }
}
