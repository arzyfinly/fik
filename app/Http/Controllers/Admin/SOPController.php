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

class SOPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $download_document = InformasiPublik::where('category_informasi_publik_id', 4)->first();
        if($download_document == null){
            $sop = ContentInformasiPublik::where('informasi_publik_id', 0)->get();
        }else{
            $sop = ContentInformasiPublik::where('informasi_publik_id', $download_document->id)->get();
        }
        // dd($download_documentPendidikan);
        if ($request->ajax()) {
            return DataTables::of($sop)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('content', function ($row) {
                    $link = '<a href="/files/sop/' . $row->content . '"> '. $row->content .' </a>';
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

                    $btn = '<a href="' . route('sop.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['content','image-content','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.informasi_publik.download_dokumen.sop.index', compact('download_document'));
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
        $path = 'images/sop';
        $header_cache = InformasiPublik::where('category_informasi_publik_id', 4)->first();
        if ($request['image_header'] == null) {

            $data['image_header'] = $header_cache['image_header'];
        }else{
            if (isset($header_cache['image_header'])) {
                File::delete('images/sop/'.$header_cache['image_header']);
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
            'category_informasi_publik_id' => '4',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/informasi-publik/download-document/sop');
    }
    public function create()
    {

        return view('admin.informasi_publik.download_dokumen.sop.create');
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
        $path = 'images/sop';
        $path_file = 'files/sop/';

        if ($request->hasfile('content')) {
            $file = $request->file('content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path_file, $nama_file);
            $data['content'] = $nama_file;
        }

        // dd($data);
        $download_document = InformasiPublik::where('category_informasi_publik_id', 4)->first();
        $content = ContentInformasiPublik::where('informasi_publik_id', $download_document->id)->where('publish', '1')->get()->count();
        if($download_document){
                $content = [
                        'informasi_publik_id'           => $download_document->id,
                        'title'                 => $data['title'],
                        'description'           => '-',
                        'content'               => $data['content'],
                        'image_content'         => '-',
                        'date'                  => $data['date'],
                        'publish'               => '1',
                    ];
                ContentInformasiPublik::create($content);
                return redirect()->route('sop.index');
        } else {
            return response()->json([
                'success' => false,
                'message' => "Isi form Dokumen SOP terlebih dahulu !!"
            ],409);
        }
        return redirect()->route('sop.index');
    }

    public function show()
    {
        return redirect('/sop');
    }

    public function edit($sop)
    {
        $download_document = ContentInformasiPublik::Find($sop);
        return view('admin.informasi_publik.download_dokumen.sop.edit', compact('download_document'));
    }

    public function update(Request $request, $sop)
    {
        $download_document = ContentInformasiPublik::Find($sop);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'nullable',
            'content'               => 'nullable|mimes:doc,docx,pdf,docm,dotx,dotm,txt|max:2000',
            'image_content'         => 'nullable',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);
        $path = 'images/sop/';
        $path_file = 'files/sop/';
        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        $data = $request->all();
        if (!isset($request['content'])) {
            $data['content'] = $download_document['content'];
        } elseif ($request->hasfile('content')) {
            $file = $request->file('content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path_file, $nama_file);
            if (File::exists('files/sop/'.$download_document['content'])) {
                File::delete('files/sop/'.$download_document['content']);
            }
            $data['content'] = $nama_file;
        } else {

        }

        if ($data['publish'] == 1) {
            $download_document = InformasiPublik::where('category_informasi_publik_id', 4)->first();
            $sop = ContentInformasiPublik::where('informasi_publik_id', $download_document->id)->where('publish', '1')->get()->count();
        }
        // dd($data);

        $download_document->update([
            'title'                 => $data['title'],
            'description'           => '-',
            'content'               => $data['content'],
            'image_content'         => '-',
            'date'                  => $data['date'],
            'publish'               => '1',
        ]);

        return redirect()->route('sop.index');
    }

    public function destroy($sop)
    {
        $download_document = ContentInformasiPublik::Find($sop);

        if (File::exists("images/sop/".$download_document->image_content)) {
            File::delete("images/sop/".$download_document->image_content);
        }

        if (File::exists("files/sop/".$download_document->content)) {
            File::delete("files/sop/".$download_document->content);
        }


        $download_document->delete();

        return response()->json([
            'success' => true,
            'message' => 'data Dokumen SOP berhasil dihapus!'
        ],200);
    }
}
