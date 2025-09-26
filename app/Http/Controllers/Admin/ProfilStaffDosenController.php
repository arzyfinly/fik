<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentProfile;
use App\Models\Profil;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;

class ProfilStaffDosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $profil = Profil::where('category_profile_id', '4')->first();
        if($profil == null){
            $staffDosenAll = ContentProfile::where('profil_id', 0)->get();
        }else{
            $staffDosenAll = ContentProfile::where('profil_id', $profil->id)->get();
        }
        // dd($staffDosenAll);
        if ($request->ajax()) {
            return DataTables::of($staffDosenAll)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('content', function ($row) {
                    // $text_content = $row->content;

                    // $hasil = Str::substr($text_content, 0, 100);
                    return $row->content;
                })
                ->addColumn('image-content', function ($row) {
                    $content = '<img src="/images/staff-dosen-fakultas/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
                    return $content;
                })
                ->addColumn('status', function ($row) {
                    if ($row->publish == '0') {
                        $haw = '<a class="badge badge-danger text-white">Not Published</a>';
                        return $haw;
                    } else {
                        $haw = '<a class="badge badge-success text-white">Published</a>';
                        return $haw;
                    };
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('staff-dosen-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.profil.profilstaffdosen.index', compact('profil'));
    }
    public function header(Request $request)
    {
        $validated = $request->validate([
            'image_header'         => 'nullable|mimes:jpeg,bmp,png,jpg|max:2000',
        ]);
        $data = $request->all();
        if($request->hasfile('image_header')){
            $file = $request->hasfile('image_header');
        }
        $path = 'images/staff-dosen-fakultas';
        $header_cache = Profil::where('category_profile_id', 4)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/staff-dosen-fakultas/'.$header_cache['image_header']);
            }
        }

        if ($request->hasfile('image_header')) {
            $file = $request->file('image_header');
            $file_name = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $file_name);
            $data['image_header'] = $file_name;
        }
        Profil::updateOrCreate(
         [
            'category_profile_id' => '4',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/profil/staff-dosen-fik');
    }
    public function create()
    {

        return view('admin.profil.profilstaffdosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'image_content'         => 'required|mimes:jpeg,bmp,png,jpg|max:512',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

    $data = $request->all();
    $path = 'images/staff-dosen-fakultas';

    if ($request->hasfile('image_content')) {
        $file = $request->file('image_content');
        $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
        $file->move($path, $nama_file);
        $data['image_content'] = $nama_file;
    }
    // dd($data);
    $profil = Profil::where('category_profile_id', '4')->first();
    $content = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->get()->count();
    if($profil){
            $content = [
                    'profil_id'             => $profil->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                    'publish'               => '1',
                ];

            ContentProfile::create($content);
            return redirect()->route('staff-dosen-fik.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Profil terlebih dahulu !!"
        ],409);
    }
        return redirect()->route('staff-dosen-fik.index');
    }

    public function show()
    {
        return redirect('/profil/staff-dosen-fik');
    }

    public function edit($pimpinan_feb)
    {
        $dosen = ContentProfile::Find($pimpinan_feb);
        return view('admin.profil.profilstaffdosen.edit', compact('dosen'));
    }

    public function update(Request $request, $pimpinan_feb)
    {
        $dosen = ContentProfile::Find($pimpinan_feb);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'image_content'         => 'nullable|mimes:jpeg,bmp,png,jpg|max:512',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        if($request['image_content'] == null) {
            $request['image_content'] = $dosen['image_content'];

        }
        $data = $request->all();
        $path = 'images/staff-dosen-fakultas';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/staff-dosen-fakultas/'.$dosen['image_content'])) {
                File::delete('images/staff-dosen-fakultas/'.$dosen['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        if ($data['publish'] == 1) {
            $profil = Profil::where('category_profile_id', 4)->first();
            $visimisi = ContentProfile::where('profil_id', $profil->id)->where('publish', '1')->get()->count();
        }
        // dd($data);

        $dosen->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => $data['date'],
            'publish'               => '1',
        ]);

        return redirect()->route('staff-dosen-fik.index');
    }

    public function destroy($pimpinan_feb)
    {
        $feb_pimpinan = ContentProfile::Find($pimpinan_feb);

        if (File::exists("images/staff-dosen-fakultas/".$feb_pimpinan->image_content)) {
            File::delete("images/staff-dosen-fakultas/".$feb_pimpinan->image_content);
        }
        $feb_pimpinan->delete();

        return response()->json([
            'success' => true,
            'message' => 'data Dosen berhasil dihapus!'
        ],200);
    }
}
