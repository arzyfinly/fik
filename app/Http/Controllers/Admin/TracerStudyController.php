<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentAlumni;
use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;
use RealRashid\SweetAlert\Facades\Alert;

class TracerStudyController extends Controller
{
    public function index(Request $request)
    {
        $alumni = Alumni::where('category_alumni_id', 3)->first();
        $tracerstudy = ContentAlumni::where('alumni_id', $alumni->id)->first();
        return view('admin.alumni.tracer_study.index', compact('tracerstudy'));
    }

    public function Update(Request $request, $pendataran_feb)
    {
        $tracer_study = ContentAlumni::Find($pendataran_feb);
        $request->validate([
            'content'               => 'nullable',
        ]);

        if($request['content'] == null){
            $request['content'] = '#';
        }
        $data = $request->all();

        $tracer_study->update([
            'content'               => $data['content'],
        ]);
        return redirect()->route('tracer-study-fik.index');
    }
}
