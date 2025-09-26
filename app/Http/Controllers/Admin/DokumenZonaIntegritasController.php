<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentInformasiPublik;
use App\Models\InformasiPublik;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;

class DokumenZonaIntegritasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $zona_integritas = InformasiPublik::where('category_informasi_publik_id', 3)->first();
        if($zona_integritas == null){
            $dokumen = ContentInformasiPublik::where('informasi_publik_id', 0)->get();
        }else{
            $dokumen = ContentInformasiPublik::where('informasi_publik_id', $zona_integritas->id)->get();
        }
        // dd($zona_integritasPendidikan);
        if ($request->ajax()) {
            return DataTables::of($dokumen)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('content', function ($row) {
                    $link = '<a href="/files/dokumen-zona-integritas/' . $row->content . '"> '. $row->content .' </a>';
                    return $link;
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

                    $btn = '<a href="' . route('dokumen-zona-integritas.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['content','image-content','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.informasi_publik.zona_integritas.dokumen.index', compact('zona_integritas'));
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
        $path = 'images/dokumen-zona-integritas';
        $header_cache = InformasiPublik::where('category_informasi_publik_id', 3)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/dokumen-zona-integritas/'.$header_cache['image_header']);
            }
        }

        if ($request->hasfile('image_header')) {
            $file = $request->file('image_header');
            $file_name = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $file_name);
            $data['image_header'] = $file_name;
        }
        InformasiPublik::updateOrCreate(
         [
            'category_informasi_publik_id' => '3',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/informasi-publik/zona-integritas/dokumen-zona-integritas');
    }
    public function create()
    {

        return view('admin.informasi_publik.zona_integritas.dokumen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'nullable',
            'content'               => 'required|mimes:doc,docx,pdf,docm,dotx,dotm,txt|max:2000',
            'image_content'         => 'nullable',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

        $data = $request->all();
        $path = 'images/dokumen-zona-integritas';
        $path_file = 'files/dokumen-zona-integritas/';

        if ($request->hasfile('content')) {
            $file = $request->file('content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path_file, $nama_file);
            $data['content'] = $nama_file;
        }

        // dd($data);
        $zona_integritas = InformasiPublik::where('category_informasi_publik_id', 3)->first();
        $content = ContentInformasiPublik::where('informasi_publik_id', $zona_integritas->id)->where('publish', '1')->get()->count();
        if($zona_integritas){
                $content = [
                        'informasi_publik_id'           => $zona_integritas->id,
                        'title'                 => $data['title'],
                        'description'           => '-',
                        'content'               => $data['content'],
                        'image_content'         => '-',
                        'date'                  => $data['date'],
                        'publish'               => '1',
                    ];
                ContentInformasiPublik::create($content);
                return redirect()->route('dokumen-zona-integritas.index');
        } else {
            return response()->json([
                'success' => false,
                'message' => "Isi form Dokumen Zona Integritas terlebih dahulu !!"
            ],409);
        }
        return redirect()->route('dokumen-zona-integritas.index');
    }

    public function show()
    {
        return redirect('/dokumen-zona-integritas');
    }

    public function edit($dokumen_zona_integritas)
    {
        $zona_integritas = ContentInformasiPublik::Find($dokumen_zona_integritas);
        return view('admin.informasi_publik.zona_integritas.dokumen.edit', compact('zona_integritas'));
    }

    public function update(Request $request, $dokumen_zona_integritas)
    {
        $zona_integritas = ContentInformasiPublik::Find($dokumen_zona_integritas);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'nullable',
            'content'               => 'nullable|mimes:doc,docx,pdf,docm,dotx,dotm,txt|max:2000',
            'image_content'         => 'nullable',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);
        $path = 'images/dokumen-zona-integritas/';
        $path_file = 'files/dokumen-zona-integritas/';
        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        $data = $request->all();
        if (!isset($request['content'])) {
            $data['content'] = $zona_integritas['content'];
        } elseif ($request->hasfile('content')) {
            $file = $request->file('content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path_file, $nama_file);
            if (File::exists('files/dokumen-zona-integritas/'.$zona_integritas['content'])) {
                File::delete('files/dokumen-zona-integritas/'.$zona_integritas['content']);
            }
            $data['content'] = $nama_file;
        } else {

        }

        if ($data['publish'] == 1) {
            $zona_integritas = InformasiPublik::where('category_informasi_publik_id', 3)->first();
            $dokumen_zona_integritas = ContentInformasiPublik::where('informasi_publik_id', $zona_integritas->id)->where('publish', '1')->get()->count();
        }
        // dd($data);

        $zona_integritas->update([
            'title'                 => $data['title'],
            'description'           => '-',
            'content'               => $data['content'],
            'image_content'         => '-',
            'date'                  => $data['date'],
            'publish'               => '1',
        ]);

        return redirect()->route('dokumen-zona-integritas.index');
    }

    public function destroy($dokumen_zona_integritas)
    {
        $zona_integritas = ContentInformasiPublik::Find($dokumen_zona_integritas);

        if (File::exists("images/dokumen-zona-integritas/".$zona_integritas->image_content)) {
            File::delete("images/dokumen-zona-integritas/".$zona_integritas->image_content);
        }

        if (File::exists("files/dokumen-zona-integritas/".$zona_integritas->content)) {
            File::delete("files/dokumen-zona-integritas/".$zona_integritas->content);
        }


        $zona_integritas->delete();

        return response()->json([
            'success' => true,
            'message' => 'data Dokumen Zona Integritas berhasil dihapus!'
        ],200);
    }
}
