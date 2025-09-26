<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kemahasiswaan;
use App\Models\ContentKemahasiswaan;

class KemahasiswaanController extends Controller
{
    public function beasiswa()
    {
        $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', '1')->first();
        if($kemahasiswaan != null)
        {
            $contentBeasiswa = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->simplePaginate(4);
            if(!$contentBeasiswa)
            {
                return view('guest.kemahasiswaan.infokemahasiswaan.beasiswa.index', compact('contentBeasiswa', 'kemahasiswaan'));
            }
            else{
                $beasiswa = $contentBeasiswa;
                return view('guest.kemahasiswaan.infokemahasiswaan.beasiswa.index', compact('beasiswa', 'kemahasiswaan', 'contentBeasiswa'));
            }
        }
        else{
            return view('guest.kemahasiswaan.infokemahasiswaan.beasiswa.index', compact('kemahasiswaan'));
        }
        return view('guest.kemahasiswaan.infokemahasiswaan.beasiswa.index');

        // $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', '1')->first();
        // $beasiswa = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->where('publish', '1')->get();

        // return view('guest.kemahasiswaan.infokemahasiswaan.beasiswa.index', compact('beasiswa','kemahasiswaan'));
    }
    public function prestasiMahasiswa()
    {
        $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', '2')->first();
        $prestasimhs = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->where('publish', '1')->get();

        return view('guest.kemahasiswaan.infokemahasiswaan.prestasimahasiswa.index', compact('prestasimhs','kemahasiswaan'));
    }
    public function bemfeb()
    {
        // $akademik = Kemahasiswaan::where('category_kemahasiswaan_id', '1')->first();
        // $panduan = ContentKemahasiswaan::where('akademik_id', $akademik->id)->where('publish', '1')->get();

        return view('guest.kemahasiswaan.ormawa.bemfst.index');
    }
    public function hima($id)
    {
        // $akademik = Kemahasiswaan::where('category_kemahasiswaan_id', '1')->first();
        // $panduan = ContentKemahasiswaan::where('akademik_id', $akademik->id)->where('publish', '1')->get();

        return view('guest.kemahasiswaan.ormawa.hima.index');
    }

    public function show($id){
        $contentKemahasiswaan = ContentKemahasiswaan::where('id', $id)->first();
        if($contentKemahasiswaan->kemahasiswaan->categoryKemahasiswaan->id == 1){
            return view('guest.kemahasiswaan.infokemahasiswaan.beasiswa.show', compact('contentKemahasiswaan'));
        }elseif($contentKemahasiswaan->kemahasiswaan->categoryKemahasiswaan->id == 2){
            return view('guest.kemahasiswaan.infokemahasiswaan.prestasimahasiswa.show', compact('contentKemahasiswaan'));
        } else {
            return view('guest.kemahasiswaan.ormawa.index', compact('contentKemahasiswaan'));
        }
    }

}
