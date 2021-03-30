<?php

namespace App\Exports;

use App\Models\Tweet;
use App\Models\Pelabelan;
use DB;
use App\Http\Controllers\TwitterController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class TweetExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;


    // public function map($Tweet): array
    // {
    //     return [
    //         $Tweet->id_tweet,
    //         $Tweet->id_user,
    //         $Tweet->tweet,
    //     ];
    // }



    public function __construct(int $id_user)
    {
        $this->id_user = $id_user;
    }

    public function query()
    {
        return Tweet::query()->where('id_user', $this->id_user);
        // return Pelabelan::query()->where('id_user', $this->id_user);
    }    
    
    public function headings(): array
    {
        return [
            'id_tweet',
            'id_user',
            'tweet',
        ];
        // return [
        //     'id_user',
        //     'j_pancasilais',
        //     'j_negative',
        //     'klasifikasi',
        // ];
    }

}
