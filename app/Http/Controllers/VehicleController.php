<?php

namespace App\Http\Controllers;

use App\Imports\VehiclesImport;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'vehicles_list' => ['required', 'file']
        ]);

        $file = $request->file('vehicles_list');

        $import = new VehiclesImport;

        try {
            $import->import($file);
        } catch (\Throwable $th) {
            return back()->with('error', 'There was a problem with your import: ' . $th->getMessage());
        }

        return back()->with('success', 'Excel file imported successfully.');
    }
}
