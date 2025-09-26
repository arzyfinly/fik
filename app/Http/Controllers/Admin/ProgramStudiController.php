<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentAcademic;
use App\Models\DetailContent;
use App\Models\Akademik;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramStudiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $akademik = Akademik::where('category_academic_id', 2)->first();
        if($akademik == null){
            $programStudi = ContentAcademic::where('akademik_id', 0)->get();
        }else{
            $programStudi = ContentAcademic::where('akademik_id', $akademik->id)->get();
        }
        // dd($programStudi);
        if ($request->ajax()) {
            return DataTables::of($programStudi)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('content', function ($row) {
                    return $row->content;
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

                    $btn =        '<a href="' . route('program-studi-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['content','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.akademik.programstudi.index', compact('akademik'));
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
        $path = 'images/program-studi-fakultas/';
        $header_cache = Akademik::where('category_academic_id', 2)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/program-studi-fakultas/'.$header_cache['image_header']);
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
            'category_academic_id' => '2',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/akademik/program-studi-fik');
    }
    public function create()
    {

        return view('admin.akademik.programstudi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required',
            'description'           => 'nullable',
            'content'               => 'required',
            'image_content'         => 'nullable',
            'date'                  => 'nullable',
            'publish'               => 'nullable',
        ]);
        // dd($request);

        $data = $request->all();

        // dd($data);
        $akademik = Akademik::where('category_academic_id', 2)->first();
        $content = ContentAcademic::where('akademik_id', $akademik->id)->where('title', $data['title'])->where('publish', '1')->get()->count();
        if($akademik){
            if($publish){
                $content = [
                        'akademik_id'           => $akademik->id,
                        'title'                 => $data['title'],
                        'description'           => '-',
                        'content'               => $data['content'],
                        'image_content'         => '-',
                        'date'                  => \Carbon\Carbon::now(),
                        'publish'               => '0',
                    ];

                ContentAcademic::create($content);
                return redirect()->route('program-studi-fik.index');
            } else {
                $content = [
                'akademik_id'           => $akademik->id,
                'title'                 => $data['title'],
                'description'           => '-',
                'content'               => $data['content'],
                'image_content'         => '-',
                'date'                  => \Carbon\Carbon::now(),
                'publish'               => '1',
                ];
                ContentAcademic::create($content);
                return redirect()->route('program-studi-fik.index');
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Isi form Akademik terlebih dahulu !!"
            ],409);
        }
        return redirect()->route('program-studi-fik.index');
    }

    public function show($program_studi_feb)
    {
        $contents = DetailContent::where('content_id', $program_studi_feb)->get();

        return view('admin.akademik.programstudi.content', compact('contents','program_studi_feb'));
    }

    public function edit($program_studi_feb)
    {
        $program_studi_feb = ContentAcademic::Find($program_studi_feb);
        return view('admin.akademik.programstudi.edit', compact('program_studi_feb'));
    }

    public function Update(Request $request, $program_studi_feb)
    {
        $prodi = ContentAcademic::Find($program_studi_feb);
        $request->validate([
            'title'                 => 'required',
            'content'               => 'required',
            'image_content'         => 'nullable',
            'date'                  => 'nullable',
            'publish'               => 'nullable',
        ]);
        $path = 'images/program-studi-fakultas/';
        $path_file = 'files/akademik/';

        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        if($request['image_content'] == null) {
            $request['image_content'] = $prodi['image_content'];

        }
        $data = $request->all();
        if ($request['content'] == null) {
            $request['content'] = $prodi['content'];
        } elseif ($request->hasfile('content')) {
            $file = $request->file('content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path_file, $nama_file);
            if (File::exists('files/akademik/'.$prodi['content'])) {
                File::delete('files/akademik/'.$prodi['content']);
            }
            $data['content'] = $nama_file;
        }

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/program-studi-fakultas/'.$prodi['image_content'])) {
                File::delete('images/program-studi-fakultas/'.$prodi['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        if ($data['publish'] == 1) {
            $akademik = Akademik::where('category_academic_id', 2)->first();
            $visimisi = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get()->count();
        }
        // dd($data);
        if(!$request['publish']){
           $prodi->update([
                'title'                 => $data['title'],
                'content'               => $data['content'],
                'publish'               => '0',
            ]);
        } else {
            $prodi->update([
                'title'                 => $data['title'],
                'content'               => $data['content'],
                'publish'               => '1',
            ]);
        }


        return redirect()->route('program-studi-fik.index');
    }

    public function destroy($program_studi_feb)
    {
        $feb_prodi = ContentAcademic::Find($program_studi_feb);

        if (File::exists("images/program-studi-fakultas/".$feb_prodi->image_content)) {
            File::delete("images/program-studi-fakultas/".$feb_prodi->image_content);
        }

        if (File::exists("files/akademik/".$feb_prodi->content)) {
            File::delete("files/akademik/".$feb_prodi->content);
        }


        $feb_prodi->delete();

        return response()->json([
            'success' => true,
            'message' => 'data Prodi berhasil dihapus!'
        ],200);
    }
    public function detailDestroy($program_studi_feb)
    {
        $feb_prodi = DetailContent::Find($program_studi_feb);
        $feb_prodi->delete();

        return response()->json([
            'success' => true,
            'message' => 'data content Prodi berhasil dihapus!'
        ],200);
    }
}
