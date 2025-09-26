<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\ContentAlumni;
use App\Models\CategoryAlumni;

class AlumniController extends Controller
{
    public function tentang()
    {
        // $akademik = Akademik::where('category_academic_id', '1')->first();
        // $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();
        $alumni = Alumni::where('category_alumni_id', 1)->first();
        if($alumni != null)
        {
            $contentAlumni = ContentAlumni::where('alumni_id', $alumni->id)->first();
            if(!$contentAlumni)
            {
                return view('guest.alumni.tentang-alumni.index', compact('contentAlumni', 'alumni'));
            }
            else{
                $tentang = $contentAlumni;
                return view('guest.alumni.tentang-alumni.index', compact('tentang', 'alumni', 'contentAlumni'));
            }
        }
        else{
            return view('guest.alumni.tentang-alumni.index', compact('alumni'));
        }
    }
    public function ikatan()
    {
        // $akademik = Akademik::where('category_academic_id', '1')->first();
        // $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();
        $alumni = Alumni::where('category_alumni_id', 2)->first();
        if($alumni != null)
        {
            $contentAlumni = ContentAlumni::where('alumni_id', $alumni->id)->first();
            if(!$contentAlumni)
            {
                return view('guest.alumni.ikatan-alumni.index', compact('contentAlumni', 'alumni'));
            }
            else{
                $ikatan = $contentAlumni;
                return view('guest.alumni.ikatan-alumni.index', compact('ikatan', 'alumni', 'contentAlumni'));
            }
        }
        else{
            return view('guest.alumni.ikatan-alumni.index', compact('alumni'));
        }
        return view('guest.alumni.ikatan-alumni.index');
    }

    public function peluang()
    {
        // $akademik = Akademik::where('category_academic_id', '1')->first();
        // $panduan = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get();
        $alumni = Alumni::where('category_alumni_id', 4)->first();
        if($alumni != null)
        {
            $contentAlumni = ContentAlumni::where('alumni_id', $alumni->id)->simplePaginate(4);
            if(!$contentAlumni)
            {
                return view('guest.alumni.peluang-kerja.index', compact('contentAlumni', 'alumni'));
            }
            else{
                $peluang = $contentAlumni;
                return view('guest.alumni.peluang-kerja.index', compact('peluang', 'alumni', 'contentAlumni'));
            }
        }
        else{
            return view('guest.alumni.peluang-kerja.index', compact('alumni'));
        }
        return view('guest.alumni.peluang-kerja.index');
    }

    public function show($id)
    {
        $contentAlumni = ContentAlumni::where('id', $id)->first();
        if($contentAlumni->alumni->categoryAlumni->id == 4){
            return view('guest.alumni.peluang-kerja.show', compact('contentAlumni'));
        }
    }
}
