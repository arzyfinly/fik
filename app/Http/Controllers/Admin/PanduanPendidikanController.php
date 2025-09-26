<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentAcademic;
use App\Models\Akademik;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;

class PanduanPendidikanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $akademik = Akademik::where('category_academic_id', 1)->first();
        if($akademik == null){
            $panduanPendidikan = ContentAcademic::where('akademik_id', 0)->get();
        }else{
            $panduanPendidikan = ContentAcademic::where('akademik_id', $akademik->id)->get();
        }
        // dd($panduanPendidikan);
        if ($request->ajax()) {
            return DataTables::of($panduanPendidikan)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('content', function ($row) {
                    $link = '<a href="/files/akademik/' . $row->content . '"> '. $row->content .' </a>';
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

                    $btn = '<a href="' . route('panduan-pendidikan-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['content','image-content','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.akademik.panduanpendidikanfeb.index', compact('akademik'));
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
        $path = 'images/panduan-pendidikan-fakultas';
        $header_cache = Akademik::where('category_academic_id', 1)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/panduan-pendidikan-fakultas/'.$header_cache['image_header']);
            }
        }

        if ($request->hasfile('image_header')) {
            $file = $request->file('image_header');
            $file_name = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $file_name);
            $data['image_header'] = $file_name;
        }
        Akademik::updateOrCreate(
         [
            'category_academic_id' => '1',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/akademik/panduan-pendidikan-fik');
    }
    public function create()
    {

        return view('admin.akademik.panduanpendidikanfeb.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required|mimes:doc,docx,pdf,docm,dotx,dotm,txt|max:2000',
            'image_content'         => 'nullable',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

        $data = $request->all();
        $path = 'images/panduan-pendidikan-fakultas';
        $path_file = 'files/akademik/';

        if ($request->hasfile('content')) {
            $file = $request->file('content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path_file, $nama_file);
            $data['content'] = $nama_file;
        }

        // dd($data);
        $akademik = Akademik::where('category_academic_id', 1)->first();
        $content = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get()->count();
        if($akademik){
                $content = [
                        'akademik_id'           => $akademik->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['content'],
                        'image_content'         => '-',
                        'date'                  => $data['date'],
                        'publish'               => '1',
                    ];
                ContentAcademic::create($content);
                return redirect()->route('panduan-pendidikan-fik.index');
        } else {
            return response()->json([
                'success' => false,
                'message' => "Isi form Akademik terlebih dahulu !!"
            ],409);
        }
        return redirect()->route('panduan-pendidikan-fik.index');
    }

    public function show()
    {
        return redirect('/akademik-fik');
    }

    public function edit($panduan_pendidikan_feb)
    {
        $panduan = ContentAcademic::Find($panduan_pendidikan_feb);
        return view('admin.akademik.panduanpendidikanfeb.edit', compact('panduan'));
    }

    public function update(Request $request, $panduan_pendidikan_feb)
    {
        $panduan = ContentAcademic::Find($panduan_pendidikan_feb);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'nullable|mimes:doc,docx,pdf,docm,dotx,dotm,txt|max:2000',
            'image_content'         => 'nullable',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);
        $path = 'images/panduan-pendidikan-fakultas/';
        $path_file = 'files/akademik/';
        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        $data = $request->all();
        if (!isset($request['content'])) {
            $data['content'] = $panduan['content'];
        } elseif ($request->hasfile('content')) {
            $file = $request->file('content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path_file, $nama_file);
            if (File::exists('files/akademik/'.$panduan['content'])) {
                File::delete('files/akademik/'.$panduan['content']);
            }
            $data['content'] = $nama_file;
        } else {

        }

        if ($data['publish'] == 1) {
            $akademik = Akademik::where('category_academic_id', 1)->first();
            $visimisi = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get()->count();
        }
        // dd($data);

        $panduan->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => '-',
            'date'                  => $data['date'],
            'publish'               => '1',
        ]);

        return redirect()->route('panduan-pendidikan-fik.index');
    }

    public function destroy($panduan_pendidikan_feb)
    {
        $feb_panduan = ContentAcademic::Find($panduan_pendidikan_feb);

        if (File::exists("images/panduan-pendidikan-fakultas/".$feb_panduan->image_content)) {
            File::delete("images/panduan-pendidikan-fakultas/".$feb_panduan->image_content);
        }

        if (File::exists("files/akademik/".$feb_panduan->content)) {
            File::delete("files/akademik/".$feb_panduan->content);
        }


        $feb_panduan->delete();

        return response()->json([
            'success' => true,
            'message' => 'data Panduan Pendidikan berhasil dihapus!'
        ],200);
    }
}
