<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContentAcademic;
use App\Models\Akademik;
use App\Models\Berita;
use App\Models\ContentBerita;
use App\Models\CategoryBerita;
use App\Models\Kemahasiswaan;
use App\Models\ContentKemahasiswaan;
use App\Models\ContentProfile;
use App\Models\Profil;

class HomeController extends Controller
{

    public function index()
    {
        //Profil
        $profil = Profil::where('category_profile_id', '5')->first();
        $fasilitas = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->limit(3)->get();

        //Akademik
        $akademik = Akademik::where('category_academic_id', '4')->first();
        $pendaftaran = ContentAcademic::where('akademik_id', $profil->id)->where('publish', '1')->first();

        //Berita
        $informasi  = Berita::where('category_berita_id', '1')->first();
        $pengumuman = Berita::where('category_berita_id', '2')->first();
        $berita     = ContentBerita::where('publish', '1')->where('berita_id', $informasi->id)->orwhere('berita_id', $pengumuman->id)->limit(3)->get();

        //Kemahasisswaan

        // dd($fasilitas);
        return view('home', compact('fasilitas','pendaftaran', 'berita'));
    }
}
