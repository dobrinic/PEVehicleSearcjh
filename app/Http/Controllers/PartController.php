<?php

namespace App\Http\Controllers;

use App\Imports\PartsImport;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'parts_list' => ['required', 'file']
        ]);

        $file = $request->file('parts_list');

        $import = new PartsImport;

        try {
            $import->import($file);
        } catch (\Throwable $th) {
            return back()->with('error', 'There was a problem with your import: ' . $th->getMessage());
        }

        return back()->with('success', 'CSV file imported successfully.');
    }
}
