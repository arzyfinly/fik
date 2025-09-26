<?php

namespace App\Http\Controllers;

use App\Models\ContentProfile;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function sejarah()
    {
        $profil = Profil::where('category_profile_id', '1')->first();
        $sejarah = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->first();
        return view('guest.profil.sejarah.index', compact('sejarah','profil'));
    }
    public function visiMisiTujuanFeb()
    {
        $profil = Profil::where('category_profile_id', '2')->first();
        $visimisitujuan = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->get();
        return view('guest.profil.visimisitujuan.index', compact('visimisitujuan', 'profil'));
    }
    public function pimpinanFeb()
    {
        $profil = Profil::where('category_profile_id', '3')->first();
        $pimpinan = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->get();
        return view('guest.profil.profilpimpinanfakultas.index', compact('pimpinan','profil'));
    }
    public function staffDosenFeb()
    {
        $profil = Profil::where('category_profile_id', '4')->first();
        $manajemen = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'MANAJEMEN')->get();
        $akuntansi = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'AKUNTANSI')->get();
        return view('guest.profil.profilstaffdosen.index', compact('profil', 'manajemen', 'akuntansi'));
    }
    public function fasilitas()
    {
        $profil = Profil::where('category_profile_id', '5')->first();
        $fasilitas = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->get();
        return view('guest.profil.fasilitasfeb.index', compact('profil', 'fasilitas'));
    }
    public function akreditasi()
    {
        $profil = Profil::where('category_profile_id', '6')->first();
        $akreditasi = ContentProfile::where('profil_id', $profil->id)->get();
        return view('guest.profil.akreditasifeb.index', compact('profil', 'akreditasi'));
    }
    // public function rencanaStrategis()
    // {
    //     // $profil = Profil::where('category_profile_id', '4')->first();
    //     // $manajemen = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'INFORMATIKA')->get();
    //     // $sisinfor = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'AKUNTANSI')->get();
    //     // $tekindustri = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'TEKNIK INDUSTRI')->get();
    //     return view('guest.profil.rencanastrategis.index');
    // }

    // public function strukturOrganisasi()
    // {
    //     // $profil = Profil::where('category_profile_id', '4')->first();
    //     // $manajemen = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'INFORMATIKA')->get();
    //     // $sisinfor = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'AKUNTANSI')->get();
    //     // $tekindustri = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->where('title', 'TEKNIK INDUSTRI')->get();
    //     return view('guest.profil.strukturorganisasi.index');
    // }

}
