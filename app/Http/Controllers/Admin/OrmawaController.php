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

class OrmawaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', 3)->first();
        if($kemahasiswaan == null){
            $ormawa = ContentKemahasiswaan::where('kemahasiswaan_id', 0)->get();
        }else{
            $ormawa = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->get();
        }
        // dd($ormawa);
        if ($request->ajax()) {
            return DataTables::of($ormawa)
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
                    $content = '<img src="/images/ormawa-fakultas/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn =        '<a href="' . route('ormawa-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns([ 'content', 'image-content','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kemahasiswaan.ormawa.index', compact('kemahasiswaan'));
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
        $path = 'images/ormawa-fakultas/';
        $header_cache = Kemahasiswaan::where('category_kemahasiswaan_id', 3)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/ormawa-fakultas/'.$header_cache['image_header']);
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
            'category_kemahasiswaan_id' => '3',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/kemahasiswaan/ormawa-fik');
    }
    public function create()
    {
        return view('admin.kemahasiswaan.ormawa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'image_content'         => 'required|mimes:jpeg,bmp,png,jpg|max:2000',
            'date'                  => 'nullable',
            'publish'               => 'nullable',
        ]);
        // dd($request);

        $data = $request->all();
        $path = 'images/ormawa-fakultas/';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            $data['image_content'] = $nama_file;
        }

        // dd($data);
        $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', 3)->first();
        $content = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->where('title', $data['title'])->where('publish', '1')->get()->count();
        if($request['publish' == null]){
                $content = [
                'kemahasiswaan_id'      => $kemahasiswaan->id,
                'title'                 => $data['title'],
                'description'           => $data['description'],
                'content'               => $data['content'],
                'image_content'         => $data['image_content'],
                'date'                  => \Carbon\Carbon::now(),
                'publish'               => '0',
                ];
                ContentKemahasiswaan::create($content);
                return redirect()->route('ormawa-fik.index');
        } else {$content = [
            'kemahasiswaan_id'      => $kemahasiswaan->id,
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => \Carbon\Carbon::now(),
            'publish'               => '1',
            ];
            ContentKemahasiswaan::create($content);
            return redirect()->route('ormawa-fik.index');
        }
        return redirect()->route('ormawa-fik.index');
    }

    public function show($ormawa)
    {
        return view('admin.kemahasiswaan.ormawa.content', compact('contents','ormawa'));
    }

    public function edit($ormawa)
    {
        $ormawa = ContentKemahasiswaan::Find($ormawa);
        return view('admin.kemahasiswaan.ormawa.edit', compact('ormawa'));
    }

    public function Update(Request $request, $ormawa)
    {
        $ormawa_feb = ContentKemahasiswaan::Find($ormawa);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'image_content'         => 'nullable|mimes:jpeg,bmp,png,jpg|max:2000',
            'date'                  => 'nullable',
            'publish'               => 'nullable',
        ]);


        $path = 'images/ormawa-fakultas/';
        $data = $request->all();
        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/ormawa-fakultas/'.$ormawa_feb['image_content'])) {
                File::delete('images/ormawa-fakultas/'.$ormawa_feb['image_content']);
            }
            $data['image_content'] = $nama_file;
        }
        // dd($data);
        if($request['publish'] == null || !$request['publish']){
           $ormawa_feb->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'publish'               => '0',
            ]);
        } else {
            $ormawa_feb->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $ormawa_feb['image_content'],
            'publish'               => '1',
            ]);
        }


        return redirect()->route('ormawa-fik.index');
    }

    public function destroy($ormawa)
    {
        $ormawa_feb = ContentKemahasiswaan::Find($ormawa);

        if (File::exists("images/ormawa-fakultas/".$ormawa_feb->image_content)) {
            File::delete("images/ormawa-fakultas/".$ormawa_feb->image_content);
        }
        $ormawa_feb->delete();

        return response()->json([
            'success' => true,
            'message' => 'data Ormawa berhasil dihapus!'
        ],200);
    }
}
