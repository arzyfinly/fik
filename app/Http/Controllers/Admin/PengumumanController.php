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

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $pengumuman = Berita::where('category_berita_id', '2')->first();

        if($pengumuman == null){
            $pengumumanAll = ContentBerita::where('berita_id', 0)->get();
        }else{
            $pengumumanAll = ContentBerita::where('berita_id', $pengumuman->id)->get();
        }
        // dd($sejarahAll);
        if ($request->ajax()) {
            return DataTables::of($pengumumanAll)
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
                    $content = '<img src="/images/berita-pengumuman/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn = '<a href="' . route('pengumuman-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.berita.pengumuman.index', compact('pengumuman'));
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
        $path = 'images/berita-pengumuman';
        $header_cache = Berita::where('category_berita_id', 2)->first();
        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/berita-pengumuman/'.$header_cache['image_header']);
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
            'category_berita_id' => '2',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/berita/pengumuman-fik');
    }
    public function create()
    {

        return view('admin.berita.pengumuman.create');
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
    $path = 'images/berita-pengumuman';

    if ($request->hasfile('image_content')) {
        $file = $request->file('image_content');
        $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
        $file->move($path, $nama_file);
        $data['image_content'] = $nama_file;
    }
    // dd($data);
    $pengumuman = Berita::where('category_berita_id', '2')->first();
    $content = ContentBerita::where('berita_id', $pengumuman->id)->where('publish', '1')->get()->count();
    if($pengumuman){
        if ($request['publish'] != null) {
            $content = [
                    'berita_id'             => $pengumuman->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                    'publish'               => $data['publish'],
                ];
            } else {
                $content = [
                    'berita_id'             => $pengumuman->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                ];
            }
            ContentBerita::create($content);

            return redirect()->route('pengumuman-fik.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Berita terlebih dahulu !!"
        ],409);
    }
        return redirect()->route('pengumuman-fik.index');
    }

    public function show()
    {
        return redirect('/berita/pengumuman-fik');
    }

    public function edit($pengumuman_feb)
    {
        $pengumuman = ContentBerita::Find($pengumuman_feb);
        return view('admin.berita.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $pengumuman_feb)
    {
        $pengumuman = ContentBerita::Find($pengumuman_feb);
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
            $request['image_content'] = $pengumuman['image_content'];

        }
        $data = $request->all();
        $path = 'images/berita-pengumuman';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/berita-pengumuman/'.$pengumuman['image_content'])) {
                File::delete('images/berita-pengumuman/'.$pengumuman['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        // if ($data['publish'] == 1) {
        //     $pengumuman = Berita::where('category_berita_id', 3)->first();
        //     $visimisi = ContentBerita::where('berita_id', $pengumuman->id)->where('publish', '1')->get()->count();
        //         if($visimisi > 1){
        //             $data['publish'] = 0;
        //         }
        // }
        // dd($data);

        $pengumuman->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('pengumuman-fik.index');
    }

    public function destroy($pengumuman_feb)
    {
        $feb_pengumuman = ContentBerita::Find($pengumuman_feb);
        if (File::exists("images/berita-pengumuman/".$feb_pengumuman->image_content)) {
            File::delete("images/berita-pengumuman/".$feb_pengumuman->image_content);
        }
        $feb_pengumuman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengumuman berhasil dihapus!'
        ],200);
    }
}
