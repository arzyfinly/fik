<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use App\Models\ContentBerita;
use DataTables;
use Str;
use File;

class InformasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $informasi = Berita::where('category_berita_id', '1')->first();

        if($informasi == null){
            $informasiAll = ContentBerita::where('berita_id', 0)->get();
        }else{
            $informasiAll = ContentBerita::where('berita_id', $informasi->id)->get();
        }
        // dd($sejarahAll);
        if ($request->ajax()) {
            return DataTables::of($informasiAll)
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
                    $content = '<img src="/images/berita-informasi/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn = '<a href="' . route('informasi-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.berita.informasi.index', compact('informasi'));
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
        $path = 'images/berita-informasi';
        $header_cache = Berita::where('category_berita_id', 1)->first();

        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/berita-informasi/'.$header_cache['image_header']);
            }
        }

        if ($request->hasfile('image_header')) {
            $file = $request->file('image_header');
            $file_name = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $file_name);
            $data['image_header'] = $file_name;
        }
        Berita::updateOrCreate(
         [
            'category_berita_id' => '1',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/berita/informasi-fik');
    }
    public function create()
    {

        return view('admin.berita.informasi.create');
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
    $path = 'images/berita-informasi';

    if ($request->hasfile('image_content')) {
        $file = $request->file('image_content');
        $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
        $file->move($path, $nama_file);
        $data['image_content'] = $nama_file;
    }
    // dd($data);
    $informasi = Berita::where('category_berita_id', '1')->first();
    $content = ContentBerita::where('berita_id', $informasi->id)->where('publish', '1')->get()->count();
    if($informasi){
        if ($request['publish'] != null) {
            $content = [
                    'berita_id'             => $informasi->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                    'publish'               => $data['publish'],
                ];
            } else {
                $content = [
                    'berita_id'             => $informasi->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                ];
            }
            ContentBerita::create($content);

            return redirect()->route('informasi-fik.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Berita terlebih dahulu !!"
        ],409);
    }
        return redirect()->route('informasi-fik.index');
    }

    public function show()
    {
        return redirect('/berita/informasi-fik');
    }

    public function edit($informasi_feb)
    {
        $informasi = ContentBerita::Find($informasi_feb);
        return view('admin.berita.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $informasi_feb)
    {
        $informasi = ContentBerita::Find($informasi_feb);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required|max:150',
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
            $request['image_content'] = $informasi['image_content'];

        }
        $data = $request->all();
        $path = 'images/berita-informasi';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/berita-informasi/'.$informasi['image_content'])) {
                File::delete('images/berita-informasi/'.$informasi['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        $informasi->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('informasi-fik.index');
    }

    public function destroy($informasi_feb)
    {
        $feb_informasi = ContentBerita::Find($informasi_feb);
        if (File::exists("images/berita-informasi/".$feb_informasi->image_content)) {
            File::delete("images/berita-informasi/".$feb_informasi->image_content);
        }
        $feb_informasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi berhasil dihapus!'
        ],200);
    }
}
