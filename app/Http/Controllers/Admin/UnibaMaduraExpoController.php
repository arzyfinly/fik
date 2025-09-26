<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InformasiPublik;
use Illuminate\Support\Facades\Auth;
use App\Models\ContentInformasiPublik;
use DataTables;
use Str;
use File;

class UnibaMaduraExpoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $download_document = InformasiPublik::where('category_informasi_publik_id', '5')->first();

        if($download_document == null){
            $download_documentAll = ContentInformasiPublik::where('informasi_publik_id', 0)->get();
        }else{
            $download_documentAll = ContentInformasiPublik::where('informasi_publik_id', $download_document->id)->get();
        }
        // dd($sejarahAll);
        if ($request->ajax()) {
            return DataTables::of($download_documentAll)
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
                    $content = '<img src="/images/uniba-madura-expo/' . $row->image_content . '" alt="FIK" title="FIK" width="100px"/>';
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

                    $btn = '<a href="' . route('uniba-madura-expo.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.informasi_publik.download_dokumen.expo.index', compact('download_document'));
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
        $path = 'images/uniba-madura-expo';
        $header_cache = InformasiPublik::where('category_informasi_publik_id', 5)->first();

        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/uniba-madura-expo/'.$header_cache['image_header']);
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
            'category_informasi_publik_id' => '5',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/informasi-publik/download-document/uniba-madura-expo');
    }
    public function create()
    {

        return view('admin.informasi_publik.download_dokumen.expo.create');
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
    $path = 'images/uniba-madura-expo';

    if ($request->hasfile('image_content')) {
        $file = $request->file('image_content');
        $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
        $file->move($path, $nama_file);
        $data['image_content'] = $nama_file;
    }
    // dd($data);
    $download_document = InformasiPublik::where('category_informasi_publik_id', '5')->first();
    $content = ContentInformasiPublik::where('informasi_publik_id', $download_document->id)->where('publish', '1')->get()->count();
    if($download_document){
        if ($request['publish'] && $content < 1) {
            $content = [
                    'informasi_publik_id'             => $download_document->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                    'publish'               => $data['publish'],
                ];
            } else {
                $content = [
                    'informasi_publik_id'             => $download_document->id,
                    'title'                 => $data['title'],
                    'description'           => $data['description'],
                    'content'               => $data['content'],
                    'image_content'         => $data['image_content'],
                    'date'                  => $data['date'],
                ];
            }
            ContentInformasiPublik::create($content);

            return redirect()->route('uniba-madura-expo.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Uniba Madura Expo terlebih dahulu !!"
        ],409);
    }
        return redirect()->route('uniba-madura-expo.index');
    }

    public function show()
    {
        return redirect('/download-document/uniba-madura-expo');
    }

    public function edit($download_document)
    {
        $download_document = ContentInformasiPublik::Find($download_document);
        return view('admin.informasi_publik.download_dokumen.expo.edit', compact('download_document'));
    }

    public function update(Request $request, $download_document)
    {
        $download_document = ContentInformasiPublik::Find($download_document);
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
            $request['image_content'] = $download_document['image_content'];

        }
        $data = $request->all();
        $path = 'images/uniba-madura-expo';

        if ($request->hasfile('image_content')) {
            $file = $request->file('image_content');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move($path, $nama_file);
            if (File::exists('images/uniba-madura-expo/'.$download_document['image_content'])) {
                File::delete('images/uniba-madura-expo/'.$download_document['image_content']);
            }
            $data['image_content'] = $nama_file;
        }

        // if ($data['publish'] == 1) {
        //     $download_document = InformasiPublik::where('category_informasi_publik_id', 5)->first();
        //     $visimisi = ContentInformasiPublik::where('informasi_publik_id', $download_document->id)->where('publish', '1')->get()->count();
        //         if($visimisi > 1){
        //             $data['publish'] = 0;
        //         }
        // }
        // dd($data);

        $download_document->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['image_content'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('uniba-madura-expo.index');
    }

    public function destroy($download_document)
    {
        $download_document = ContentInformasiPublik::Find($download_document);
        if (File::exists("images/uniba-madura-expo/".$download_document->image_content)) {
            File::delete("images/uniba-madura-expo/".$download_document->image_content);
        }
        $download_document->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Uniba Madura Expo berhasil dihapus!'
        ],200);
    }
}
