<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kemahasiswaan;
use Illuminate\Support\Facades\Auth;
use App\Models\ContentKemahasiswaan;
use DataTables;
use Str;
use File;

class PrestasiMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $prestasimhs = Kemahasiswaan::where('category_kemahasiswaan_id', '2')->first();

        if($prestasimhs == null){
            $prestasimhsAll = ContentKemahasiswaan::where('kemahasiswaan_id', 0)->get();
        }else{
            $prestasimhsAll = ContentKemahasiswaan::where('kemahasiswaan_id', $prestasimhs->id)->get();
        }
        // dd($sejarahAll);
        if ($request->ajax()) {
            return DataTables::of($prestasimhsAll)
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
                    $content = '<img src="/images/prestasimhs-fakultas/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn = '<a href="' . route('prestasi-mahasiswa-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kemahasiswaan.prestasi_mhs.index', compact('prestasimhs'));
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
        $path = 'images/prestasimhs-fakultas';
        $header_cache = Kemahasiswaan::where('category_kemahasiswaan_id', 2)->first();

        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/prestasimhs-fakultas/'.$header_cache['image_header']);
            }
        }

        if ($request->hasfile('image_header')) {
            $file = $request->file('image_header');
            $file_name = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $file_name);
            $data['image_header'] = $file_name;
        }
        Kemahasiswaan::updateOrCreate(
         [
            'category_kemahasiswaan_id' => '2',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/kemahasiswaan/prestasi-mahasiswa-fik');
    }
    public function create()
    {

        return view('admin.kemahasiswaan.prestasi_mhs.create');
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
    $path = 'images/prestasimhs-fakultas';

    if ($request->hasfile('image_content')) {
        $file = $request->file('image_content');
        $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
        $file->move($path, $nama_file);
        $data['image_content'] = $nama_file;
    }
    // dd($data);
    $prestasimhs = Kemahasiswaan::where('category_kemahasiswaan_id', '2')->first();
    $content = ContentKemahasiswaan::where('kemahasiswaan_id', $prestasimhs->id)->where('publish', '1')->get()->count();
    if($prestasimhs){
        if ($request['publish'] != null) {
            $content = [
                    'kemahasiswaan_id'      => $prestasimhs->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                    'publish'               => $data['publish'],
                ];
            } else {
                $content = [
                    'kemahasiswaan_id'             => $prestasimhs->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                ];
            }
            ContentKemahasiswaan::create($content);

            return redirect()->route('prestasi-mahasiswa-fik.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Kemahasiswaan terlebih dahulu !!"
        ],409);
    }
        return redirect()->route('prestasi-mahasiswa-fik.index');
    }

    public function show()
    {
        return redirect('/kemahasiswaan/prestasi-mahasiswa-fik');
    }

    public function edit($prestasimhs_feb)
    {
        $prestasimhs = ContentKemahasiswaan::Find($prestasimhs_feb);
        return view('admin.kemahasiswaan.prestasi_mhs.edit', compact('prestasimhs'));
    }

    public function update(Request $request, $prestasimhs_feb)
    {
        $prestasimhs = ContentKemahasiswaan::Find($prestasimhs_feb);
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
            $request['image_content'] = $prestasimhs['image_content'];

        }
        $data = $request->all();
        $path = 'images/prestasimhs-fakultas';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/prestasimhs-fakultas/'.$prestasimhs['image_content'])) {
                File::delete('images/prestasimhs-fakultas/'.$prestasimhs['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        $prestasimhs->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('prestasi-mahasiswa-fik.index');
    }

    public function destroy($prestasimhs_feb)
    {
        $feb_prestasimhs = ContentKemahasiswaan::Find($prestasimhs_feb);
        if (File::exists("images/prestasimhs-fakultas/".$feb_prestasimhs->image_content)) {
            File::delete("images/prestasimhs-fakultas/".$feb_prestasimhs->image_content);
        }
        $feb_prestasimhs->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi berhasil dihapus!'
        ],200);
    }
}
