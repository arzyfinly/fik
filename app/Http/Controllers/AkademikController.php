<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentAcademic;
use App\Models\Akademik;

class AkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function panduanPendidikanFeb()
    {
        $akademik = Akademik::where('category_academic_id', '1')->first();
        $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();

        return view('guest.akademik.panduanpendidikanfeb.index', compact('panduan', 'akademik'));
    }
    // public function bukuPedomanSkripsiFeb()
    // {
    //     // $akademik = Akademik::where('category_academic_id', '1')->first();
    //     // $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();

    //     return view('guest.akademik.bukupedomanskripsi.index');
    // }
    public function kalenderAkademikFeb()
    {
        $akademik = Akademik::where('category_academic_id', '3')->first();
        $kalenderAkademik = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();

        return view('guest.akademik.kalenderakademik.index', compact('akademik','kalenderAkademik'));
    }
    public function yudisiumDanWisuda()
    {
        $akademik = Akademik::where('category_academic_id', '4')->first();
        $yudwis = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();

        return view('guest.akademik.yudisiumdanwisuda.index', compact('akademik','yudwis'));
    }


}
