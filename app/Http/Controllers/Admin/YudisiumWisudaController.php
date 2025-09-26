<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akademik;
use App\Models\ContentAcademic;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;


class YudisiumWisudaController extends Controller
{
    public function index(Request $request)
    {
        $akademik = Akademik::where('category_academic_id', '4')->first();
        if($akademik == null){
            $yudisiumwisudaall = ContentAcademic::where('akademik_id', 0)->get();
        }else{
            $yudisiumwisudaall = ContentAcademic::where('akademik_id', $akademik->id)->get();
        }
        // dd($yudisiumwisudaall);
        if ($request->ajax()) {
            return DataTables::of($yudisiumwisudaall)
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('place', function ($row) {
                    return $row->description;
                })
                ->addColumn('content', function ($row) {
                    $text_content = $row->content;

                    $hasil = Str::substr($text_content, 0, 100);

                    $hasil = "$hasil.............";
                    return $hasil;
                })
                ->addColumn('time-range', function ($row) {
                    return $row->image_content;
                })
                ->addColumn('date', function ($row) {
                    return $row->date;
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

                    $btn = '<a href="' . route('yudisium-wisuda-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['content','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.akademik.yudisiumwisuda.index', compact('akademik'));
    }

    public function header(Request $request)
    {
        $data = $request->all();
        $path = 'images/yudisium-wisuda';
        $file = $request->hasfile('image_header');

        $header_cache = Akademik::where('category_academic_id', 4)->first();
        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/yudisium-wisuda/'.$header_cache['image_header']);
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
            'category_academic_id' => '4',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/akademik/yudisium-wisuda-fik');
    }

    public function create()
    {
        $akademik = Akademik::where('category_academic_id', 4)->first();
        return view('admin.akademik.yudisiumwisuda.create', compact('akademik'));
    }

    public function store(Request $request)
    {

            $validated = $request->validate([
                'title'                 => 'required',
                'description'           => 'required',
                'content'               => 'required',
                'start'                 => 'required',
                'end'                   => 'required',
                'date'                  => 'required',
                'publish'               => 'nullable',
            ]);

        $data = $request->all();

        $akademik = Akademik::where('category_academic_id', '4')->first();
        $content = ContentAcademic::where('akademik_id', $akademik->id)->where('publish', '1')->get()->count();
        if($akademik){
            if ($request['publish']) {
                $content = [
                        'akademik_id'           => $akademik->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['content'],
                        'image_content'         => $data['start']. ' - ' .$data['end'],
                        'date'                  => $data['date'],
                        'publish'               => $data['publish'],
                    ];
                } else {
                    $content = [
                        'akademik_id'           => $akademik->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['content'],
                        'image_content'         => $data['start']. ' - ' .$data['end'],
                        'date'                  => $data['date'],
                    ];
                }
                ContentAcademic::create($content);

                return redirect()->route('yudisium-wisuda-fik.index');
        } else {
            return response()->json([
                'success' => false,
                'message' => "Isi form Akademik terlebih dahulu !!"
            ],409);
        }





    }

    public function show()
    {
        return redirect('/akademik/visi-misi-tujuan-fik');
    }

    public function edit($data_wisuda)
    {
        $yudisiumwisuda = ContentAcademic::Find($data_wisuda);
        return view('admin.akademik.yudisiumwisuda.edit', compact('yudisiumwisuda'));
    }

    public function update(Request $request, $data_wisuda)
    {
        $feb_yuwis = ContentAcademic::Find($data_wisuda);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'start'                 => 'required',
            'end'                   => 'required',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);

        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }

        $data = $request->all();
        // dd($data);

        $feb_yuwis->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['start']. ' - ' .$data['end'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('yudisium-wisuda-fik.index');
    }

    public function destroy($data_wisuda)
    {
        $feb_yuwis = ContentAcademic::Find($data_wisuda);
        $feb_yuwis->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Yudisium atau Wisuda berhasil dihapus!'
        ],200);
    }
}
