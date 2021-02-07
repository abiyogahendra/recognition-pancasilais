<?php

namespace App\Imports;

use App\Models\CleanText;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CleanTextImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //
        // dd($row);
        return new CleanText([
            'id_user'       => $row['id_user'],
            'clean_tweet'   => $row['tweet_tokens_wsw']
            
        ]);

    }
}
