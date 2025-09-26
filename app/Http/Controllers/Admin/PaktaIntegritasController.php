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

class PaktaIntegritasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $zona_integritas = InformasiPublik::where('category_informasi_publik_id', '1')->first();

        if($zona_integritas == null){
            $zona_integritasAll = ContentInformasiPublik::where('informasi_publik_id', 0)->get();
        }else{
            $zona_integritasAll = ContentInformasiPublik::where('informasi_publik_id', $zona_integritas->id)->get();
        }
        // dd($sejarahAll);
        if ($request->ajax()) {
            return DataTables::of($zona_integritasAll)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('content', function ($row) {
                    $text_content = $row->content;

                    $hasil = Str::substr($text_content, 0, 100);

                    $hasil = "$hasil.............";
                    return $hasil;
                })
                ->addColumn('image-content', function ($row) {
                    $content = '<img src="/images/pakta-integritas/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn = '<a href="' . route('pakta-integritas.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.informasi_publik.zona_integritas.pakta.index', compact('zona_integritas'));
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
        $path = 'images/pakta-integritas';
        $header_cache = InformasiPublik::where('category_informasi_publik_id', 1)->first();

        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/pakta-integritas/'.$header_cache['image_header']);
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
            'category_informasi_publik_id' => '1',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/informasi-publik/zona-integritas/pakta-integritas');
    }
    public function create()
    {
        return view('admin.informasi_publik.zona_integritas.pakta.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'image_content'         => 'required|mimes:jpeg,bmp,png,jpg|max:2000',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

    $data = $request->all();
    $path = 'images/pakta-integritas';

    if ($request->hasfile('image_content')) {
        $file = $request->file('image_content');
        $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
        $file->move($path, $nama_file);
        $data['image_content'] = $nama_file;
    }
    // dd($data);
    $zona_integritas = InformasiPublik::where('category_informasi_publik_id', '1')->first();
    $content = ContentInformasiPublik::where('informasi_publik_id', $zona_integritas->id)->where('publish', '1')->get()->count();
    if($zona_integritas){
        if ($request['publish'] && $content < 1) {
            $content = [
                    'informasi_publik_id'             => $zona_integritas->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                    'publish'               => $data['publish'],
                ];
            } else {
                $content = [
                    'informasi_publik_id'             => $zona_integritas->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                ];
            }
            ContentInformasiPublik::create($content);

            return redirect()->route('pakta-integritas.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Pakta Integritas terlebih dahulu !!"
        ],209);
    }
        return redirect()->route('pakta-integritas.index');
    }

    public function show()
    {
        return redirect('/zona-integritas/pakta-integritas');
    }

    public function edit($pakta_integritas)
    {
        $zona_integritas = ContentInformasiPublik::Find($pakta_integritas);
        return view('admin.informasi_publik.zona_integritas.pakta.edit', compact('zona_integritas'));
    }

    public function update(Request $request, $pakta_integritas)
    {
        $zona_integritas = ContentInformasiPublik::Find($pakta_integritas);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'image_content'         => 'nullable|mimes:jpeg,bmp,png,jpg|max:2000',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);
        // dd($request);
        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        if($request['image_content'] == null) {
            $request['image_content'] = $zona_integritas['image_content'];

        }
        $data = $request->all();
        $path = 'images/pakta-integritas';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/pakta-integritas/'.$zona_integritas['image_content'])) {
                File::delete('images/pakta-integritas/'.$zona_integritas['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        // if ($data['publish'] == 1) {
        //     $zona_integritas = InformasiPublik::where('category_berita_id', 2)->first();
        //     $visimisi = ContentBerita::where('berita_id', $zona_integritas->id)->where('publish', '1')->get()->count();
        //         if($visimisi > 1){
        //             $data['publish'] = 0;
        //         }
        // }
        // dd($data);

        $zona_integritas->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('pakta-integritas.index');
    }

    public function destroy($pakta_integritas)
    {
        $pakta_integritas = ContentInformasiPublik::Find($pakta_integritas);
        if (File::exists("images/pakta-integritas/".$pakta_integritas->image_content)) {
            File::delete("images/pakta-integritas/".$pakta_integritas->image_content);
        }
        $pakta_integritas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Aturan Gratifikasi berhasil dihapus!'
        ],200);
    }
}
