<?php

namespace App\Imports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class VehiclesImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // TODO: This table should be normalized for production purposes
        return new Vehicle([
            'vehicle_id' => $row['vehicle_id'],
            'bike_producer' => $row['bike_producer'],
            'series' => $row['series'],
            'size' => $row['size'],
            'configuration' => $row['configuration'],
            'bike_model' => $row['bike_model'],
            'sales_name' => $row['sales_name'],
            'year' => $row['year'],
            'cylinder' => $row['cylinder'],
            'type_of_drive' => $row['type_of_drive'],
            'engine_output' => $row['engine_output'],
            'country' => $row['country'],
            'category_1' => $row['category_1'],
            'category_2' => $row['category_2'],
        ]);
    }

    public function rules(): array
    {
        return[
            '*.vehicle_id' => ['required', 'integer', 'unique:vehicles,vehicle_id'],
            'bike_producer' => 'required',
            'series' => 'required',
            'size' => 'present',
            'configuration' => 'present',
            'bike_model' => 'required',
            'sales_name' => 'present',
            'year' => 'required',
            'cylinder' => 'present',
            'type_of_drive' => 'required',
            'engine_output' => 'present',
            'country' => 'required',
            'category_1' => 'required',
            'category_2' => 'required',
        ];
    }
}
