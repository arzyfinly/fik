<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentKemahasiswaan;
use App\Models\Kemahasiswaan;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;
use RealRashid\SweetAlert\Facades\Alert;


class BeasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', 1)->first();
        if($kemahasiswaan == null){
            $beasiswaKemahasiswaan = ContentKemahasiswaan::where('kemahasiswaan_id', 0)->get();
        }else{
            $beasiswaKemahasiswaan = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->get();
        }
        // dd($beasiswaKemahasiswaan);
        if ($request->ajax()) {
            return DataTables::of($beasiswaKemahasiswaan)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('content', function ($row) {
                    $text_content = $row->content;

                    $hasil = Str::substr($text_content, 0, 100);

                    $hasil = "$hasil.............";
                    return $hasil;
                })
                ->addColumn('image', function ($row) {
                    $content = '<img src="/images/beasiswa-fakultas/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn = '<a href="' . route('beasiswa-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image','status','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kemahasiswaan.beasiswa.index', compact('kemahasiswaan'));
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
        $path = 'images/beasiswa-fakultas';
        $header_cache = Kemahasiswaan::where('category_kemahasiswaan_id', 1)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/beasiswa-fakultas/'.$header_cache['image_header']);
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
            'category_kemahasiswaan_id' => '1',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/kemahasiswaan/info-kemahasiswaan/beasiswa-fik');
    }
    public function create()
    {

        return view('admin.kemahasiswaan.beasiswa.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'image_content'         => 'nullable|mimes:jpeg,bmp,png,jpg|max:2000',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

        $data = $request->all();
        $path = 'images/beasiswa-fakultas';
        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            $data['image_content'] = $nama_file;
        }
        // dd($data);
        $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', 1)->first();
        $content = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->where('publish', 1)->get()->count();
        if($kemahasiswaan){
            if ($request['publish']) {
                $content = [
                        'kemahasiswaan_id'      => $kemahasiswaan->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['content'],
                        'image_content'         => $data['image_content'],
                        'date'                  => $data['date'],
                        'publish'               => $data['publish'],
                    ];
                } else {
                    $content = [
                        'kemahasiswaan_id'      => $kemahasiswaan->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['content'],
                        'image_content'         => $data['image_content'],
                        'date'                  => $data['date'],
                    ];
                }
                ContentKemahasiswaan::create($content);

                return redirect()->route('beasiswa-fik.index');
        } else {
            Alert::toast('isi form Kemahasiswaan diatas terlebih dahulu','error');
            return redirect()->route('beasiswa-fik.index');
        }
            return redirect()->route('beasiswa-fik.index');
    }

    public function show()
    {
        return redirect('/kemahasiswaan/info-kemahasiswaan/beasiswa-fik');
    }

    public function edit($beasiswa_kemahasiswaan)
    {
        $beasiswa = ContentKemahasiswaan::Find($beasiswa_kemahasiswaan);
        return view('admin.kemahasiswaan.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, $beasiswa_kemahasiswaan)
    {
        $beasiswa = ContentKemahasiswaan::Find($beasiswa_kemahasiswaan);
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
            // dd($request);
            $request['image_content'] = $beasiswa['image_content'];
        }
        $data = $request->all();
        $path = 'images/beasiswa-fakultas';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/beasiswa-fakultas/'.$beasiswa['image_content'])) {
                File::delete('images/beasiswa-fakultas/'.$beasiswa['image_content']);
            }
            $data['image_content'] = $nama_file;
        }
        // dd($data);

            $beasiswa->update([
                'title'                 => $data['title'],
                'description'           => $data['description'],
                'content'               => $data['content'],
                'image_content'         => $data['image_content'],
                'date'                  => $data['date'],
                'publish'               => $data['publish'],
            ]);

        return redirect()->route('beasiswa-fik.index');
    }

    public function destroy($beasiswa_kemahasiswaan)
    {
        $feb_beasiswa = ContentKemahasiswaan::Find($beasiswa_kemahasiswaan);

        if (File::exists("/images/beasiswa-fakultas/".$feb_beasiswa->image_content)) {
            File::delete("/images/beasiswa-fakultas/".$feb_beasiswa->image_content);
        }
        $feb_beasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Beasiswa berhasil dihapus!'
        ],200);
    }
}
