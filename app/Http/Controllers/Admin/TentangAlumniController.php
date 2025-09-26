<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentAlumni;
use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;

class TentangAlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $alumni = Alumni::where('category_alumni_id', '1')->first();

        if($alumni == null){
            $alumniAll = ContentAlumni::where('alumni_id', 0)->get();
        }else{
            $alumniAll = ContentAlumni::where('alumni_id', $alumni->id)->get();
        }
        // dd($sejarahAll);
        if ($request->ajax()) {
            return DataTables::of($alumniAll)
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
                    $content = '<img src="/images/tentang-alumni/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn = '<a href="' . route('tentang-alumni-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.alumni.tentang.index', compact('alumni'));
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
        $path = 'images/tentang-alumni';
        $header_cache = Alumni::where('category_alumni_id', 1)->first();

        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/tentang-alumni/'.$header_cache['image_header']);
            }
        }

        if ($request->hasfile('image_header')) {
            $file = $request->file('image_header');
            $file_name = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $file_name);
            $data['image_header'] = $file_name;
        }
        Alumni::updateOrCreate(
         [
            'category_alumni_id' => '1',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/alumni/tentang-alumni-fik');
    }
    public function create()
    {
        return view('admin.alumni.tentang.create');
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
    $path = 'images/tentang-alumni';

    if ($request->hasfile('image_content')) {
        $file = $request->file('image_content');
        $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
        $file->move($path, $nama_file);
        $data['image_content'] = $nama_file;
    }
    // dd($data);
    $alumni = Alumni::where('category_alumni_id', '1')->first();
    $content = ContentAlumni::where('alumni_id', $alumni->id)->where('publish', '1')->get()->count();
    if($alumni){
        if ($request['publish'] != null) {
            $content = [
                    'alumni_id'             => $alumni->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                    'publish'               => $data['publish'],
                ];
            } else {
                $content = [
                    'alumni_id'             => $alumni->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                ];
            }
            ContentAlumni::create($content);

            return redirect()->route('tentang-alumni-fik.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Tentang Alumni terlebih dahulu !!"
        ],409);
    }
        return redirect()->route('tentang-alumni-fik.index');
    }

    public function show()
    {
        return redirect('/alumni/tentang-alumni-fik');
    }

    public function edit($tentang_alumni)
    {
        $alumni = ContentAlumni::Find($tentang_alumni);
        return view('admin.alumni.tentang.edit', compact('alumni'));
    }

    public function update(Request $request, $tentang_alumni)
    {
        $alumni = ContentAlumni::Find($tentang_alumni);
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
            $request['image_content'] = $alumni['image_content'];

        }
        $data = $request->all();
        $path = 'images/tentang-alumni';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/tentang-alumni/'.$alumni['image_content'])) {
                File::delete('images/tentang-alumni/'.$alumni['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        $alumni->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('tentang-alumni-fik.index');
    }

    public function destroy($tentang_alumni)
    {
        $feb_tentang = ContentAlumni::Find($tentang_alumni);
        if (File::exists("images/tentang-alumni/".$feb_tentang->image_content)) {
            File::delete("images/tentang-alumni/".$feb_tentang->image_content);
        }
        $feb_tentang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data tentang alumni berhasil dihapus!'
        ],200);
    }
}
