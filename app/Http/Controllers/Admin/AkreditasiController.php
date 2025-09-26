<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentProfile;
use App\Models\Profil;
use App\Http\Requests\AkreditasiRequest;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;

class AkreditasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $profil = Profil::where('category_profile_id', 6)->first();
        if($profil == null){
            $akreditasiAll = ContentProfile::where('profil_id', 0)->get();
        }else{
            $akreditasiAll = ContentProfile::where('profil_id', $profil->id)->get();
        }
        // dd($akreditasiAll);
        if ($request->ajax()) {
            return DataTables::of($akreditasiAll)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('image_content', function ($row) {
                    return $row->image_content;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('content', function ($row) {
                    return $row->content;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('akreditasi-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns([ 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.profil.akreditasifeb.index', compact('profil'));
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
        $path = 'images/akreditasi-fakultas';
        $header_cache = Profil::where('category_profile_id', 6)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/akreditasi-fakultas/'.$header_cache['image_header']);
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
            'category_profile_id' => 6,
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/profil/akreditasi-fik');
    }
    public function create()
    {

        // return view('admin.profil.akreditasifeb.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'no_sk'                 => 'required',
            'start'                 => 'required',
            'end'                   => 'required|after_or_equal:start',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

        $data = $request->all();
        $path = 'images/akreditasi-fakultas';
        // dd($data);
        $profil = Profil::where('category_profile_id', 6)->first();
        $content = ContentProfile::where('profil_id', $profil->id)->where('publish', 1)->get()->count();
        if($profil){
            if ($request['publish']) {
                $content = [
                        'profil_id'             => $profil->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['start'].' - '.$data['end'],
                        'image_content'         => $data['no_sk'],
                        'date'                  => $data['date'],
                        'publish'               => $data['publish'],
                    ];
                } else {
                    $content = [
                        'profil_id'             => $profil->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['start'].' - '.$data['end'],
                        'image_content'         => $data['no_sk'],
                        'date'                  => $data['date'],
                    ];
                }
                ContentProfile::create($content);

                return redirect()->route('akreditasi-fik.index');
        } else {
            return response()->json([
                'success' => false,
                'message' => "Isi form Profil terlebih dahulu !!"
            ],409);
        }
            return redirect()->route('akreditasi-fik.index');
    }

    public function show()
    {
        return redirect('/profil/akreditasi-fik');
    }

    public function edit($akreditasi_feb)
    {
        $akreditasi = ContentProfile::Find($akreditasi_feb);
        return view('admin.profil.akreditasifeb.edit', compact('akreditasi'));
    }

    public function update(Request $request, $akreditasi_feb)
    {
        $akreditasi = ContentProfile::Find($akreditasi_feb);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'no_sk'                 => 'required',
            'start'                 => 'required',
            'end'                   => 'required|after_or_equal:start',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        $data = $request->all();
        // dd($data);

        $akreditasi->update([
                'title'                 => $data['title'],
                'description'           => $data['description'],
                'content'               => $data['start'].' - '.$data['end'],
                'image_content'         => $data['no_sk'],
                'date'                  => $data['date'],
                'publish'               => $data['publish'],
        ]);

        return redirect()->route('akreditasi-fik.index');
    }

    public function destroy($akreditasi_feb)
    {
        $feb_akreditasi = ContentProfile::Find($akreditasi_feb);

        if (File::exists("/images/akreditasi-fakultas/".$feb_akreditasi->file)) {
            File::delete("/images/akreditasi-fakultas/".$feb_akreditasi->file);
        }
        $feb_akreditasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Akreditasi berhasil dihapus!'
        ],200);
    }
}
