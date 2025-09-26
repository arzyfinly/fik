<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\ContentBerita;
use App\Models\CategoryBerita;

class BeritaController extends Controller
{
    public function informasi()
    {
        // $akademik = Akademik::where('category_academic_id', '1')->first();
        // $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();
        $berita = Berita::where('category_berita_id', 1)->first();
        if($berita != null)
        {
            $contentBerita = ContentBerita::where('berita_id', $berita->id)->simplePaginate(4);
            if(!$contentBerita)
            {
                return view('guest.berita.informasi.index', compact('contentBerita', 'berita'));
            }
            else{
                $informasi = $contentBerita;
                return view('guest.berita.informasi.index', compact('informasi', 'berita', 'contentBerita'));
            }
        }
        else{
            return view('guest.berita.informasi.index', compact('berita'));
        }
    }
    public function pengumuman()
    {
        // $akademik = Akademik::where('category_academic_id', '1')->first();
        // $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();
        $berita = Berita::where('category_berita_id', 2)->first();
        if($berita != null)
        {
            $contentBerita = ContentBerita::where('berita_id', $berita->id)->simplePaginate(4);
            if(!$contentBerita)
            {
                return view('guest.berita.pengumuman.index', compact('contentBerita', 'berita'));
            }
            else{
                $pengumuman = $contentBerita;
                return view('guest.berita.pengumuman.index', compact('pengumuman', 'berita', 'contentBerita'));
            }
        }
        else{
            return view('guest.berita.pengumuman.index', compact('berita'));
        }
        return view('guest.berita.pengumuman.index');
    }
    public function agenda()
    {
        // $akademik = Akademik::where('category_academic_id', '1')->first();
        // $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();
        $berita = Berita::where('category_berita_id', 3)->first();
        if($berita != null)
        {
            $contentBerita = ContentBerita::where('berita_id', $berita->id)->simplePaginate(4);
            if(!$contentBerita)
            {
                return view('guest.berita.agenda.index', compact('contentBerita', 'berita'));
            }
            else{
                $agenda = $contentBerita;
                return view('guest.berita.agenda.index', compact('agenda', 'berita', 'contentBerita'));
            }
        }
        else{
            return view('guest.berita.agenda.index', compact('berita'));
        }
        return view('guest.berita.agenda.index');
    }
    public function show($id)
    {
        $contentBerita = ContentBerita::where('id', $id)->first();
        if($contentBerita->berita->categoryBerita->id == 1){
            return view('guest.berita.informasi.show', compact('contentBerita'));
        }else if($contentBerita->berita->categoryBerita->id == 2){
            return view('guest.berita.pengumuman.show', compact('contentBerita'));
        }
    }
}
