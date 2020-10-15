<?php

namespace App\Imports;

use App\Models\Part;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PartsImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $part = new Part;
            $part->id = $row['id'];
            $part->name = $row['name'];
            $part->active = $row['active'];
            $part->save();

            if ($row['vehicle_ids'] != null) {

                $vehicle_ids = array_unique(explode(',', $row['vehicle_ids']));

                foreach ($vehicle_ids as $vehicle_id) {
                    try {
                        $part->vehicles()->attach($vehicle_id);
                    } catch (QueryException $e) {
                        Log::alert($e->getMessage());
                    }
                }
            }
        }
    }

    public function rules(): array
    {
        return[
            '*.id' => ['required', 'integer', 'unique:parts,id']
        ];
    }
}
