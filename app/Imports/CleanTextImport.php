<?php

namespace App\Imports;

use App\Models\CleanText;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class CleanTextImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        //
        return new CleanText([
            'id_user'       => $row[2],
            'tweet_clean'   => $row[6]
        ]);

    }
}
