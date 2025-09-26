<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiPublik;
use App\Models\ContentInformasiPublik;

class InformasiPublikController extends Controller
{
    public function expo()
    {
        $informasiPublik = InformasiPublik::where('category_informasi_publik_id', '4')->first();
        $expo = ContentInformasiPublik::where('informasi_publik_id', $informasiPublik->id)->where('publish', '1')->get();

        return view('guest.informasi_publik.download_dokumen.expo.index', compact('expo', 'informasiPublik'));
    }
    public function sop()
    {
        $informasiPublik = InformasiPublik::where('category_informasi_publik_id', '5')->first();
        $sop = ContentInformasiPublik::where('informasi_publik_id', $informasiPublik->id)->where('publish', '1')->get();

        return view('guest.informasi_publik.download_dokumen.sop.index', compact('sop', 'informasiPublik'));
    }
    public function aturan()
    {
        $informasiPublik = InformasiPublik::where('category_informasi_publik_id', '2')->first();
        $aturan = ContentInformasiPublik::where('informasi_publik_id', $informasiPublik->id)->where('publish', '1')->get();

        return view('guest.informasi_publik.zona_integritas.atura.index', compact('aturan', 'informasiPublik'));
    }
    public function dokumen()
    {
        $informasiPublik = InformasiPublik::where('category_informasi_publik_id', '3')->first();
        $dokumen = ContentInformasiPublik::where('informasi_publik_id', $informasiPublik->id)->where('publish', '1')->get();

        return view('guest.informasi_publik.zona_integritas.dokumen.index', compact('dokumen', 'informasiPublik'));
    }
    public function pakta()
    {
        $informasiPublik = InformasiPublik::where('category_informasi_publik_id', '1')->first();
        $pakta = ContentInformasiPublik::where('informasi_publik_id', $informasiPublik->id)->where('publish', '1')->get();

        return view('guest.informasi_publik.zona_integritas.pakta.index', compact('pakta', 'informasiPublik'));
    }


}
