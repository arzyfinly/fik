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

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $agenda = Berita::where('category_berita_id', '3')->first();

        if($agenda == null){
            $agendaAll = ContentBerita::where('berita_id', 0)->get();
        }else{
            $agendaAll = ContentBerita::where('berita_id', $agenda->id)->get();
        }
        // dd($sejarahAll);
        if ($request->ajax()) {
            return DataTables::of($agendaAll)
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

                    $btn = '<a href="' . route('agenda-fik.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                    $btn = $btn . '&nbsp;';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['image-header', 'image-content', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.berita.agenda.index', compact('agenda'));
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
        $path = 'images/berita-agenda';
        $header_cache = Berita::where('category_berita_id', 3)->first();
        if ($request['image_header'] == null) {
            $data['image_header'] = $header_cache['image_header'];
        }else{
            if ($header_cache != null) {
                File::delete('images/berita-agenda/'.$header_cache['image_header']);
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
            'category_berita_id' => '3',
         ],
         [  'keyword'      => $data['keyword'],
            'image_header' => $data['image_header'],
         ]);

        return redirect('admin/berita/agenda-fik');
    }
    public function create()
    {

        return view('admin.berita.agenda.create');
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

    // dd($data);
    $agenda = Berita::where('category_berita_id', '3')->first();
    $content = ContentBerita::where('berita_id', $agenda->id)->where('publish', '1')->get()->count();
    if($agenda){
        if ($request['publish'] != null) {
            $content = [
                        'berita_id'             => $agenda->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['content'],
                        'image_content'         => $data['start']. ' - ' .$data['end'],
                        'date'                  => $data['date'],
                        'publish'               => $data['publish'],
                ];
            } else {
                $content = [
                        'berita_id'           => $agenda->id,
                        'title'                 => $data['title'],
                        'description'           => $data['description'],
                        'content'               => $data['content'],
                        'image_content'         => $data['start']. ' - ' .$data['end'],
                        'date'                  => $data['date'],
                ];
            }
            ContentBerita::create($content);

            return redirect()->route('agenda-fik.index');
    } else {
        return response()->json([
            'success' => false,
            'message' => "Isi form Berita terlebih dahulu !!"
        ],409);
    }
        return redirect()->route('agenda-fik.index');
    }

    public function show()
    {
        return redirect('/berita/agenda-fik');
    }

    public function edit($agenda_feb)
    {
        $agenda = ContentBerita::Find($agenda_feb);
        return view('admin.berita.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $agenda_feb)
    {
        $agenda = ContentBerita::Find($agenda_feb);
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'content'               => 'required',
            'start'                 => 'required',
            'end'                   => 'required',
            'date'                  => 'required',
            'publish'               => 'nullable',
        ]);
        // dd($request);
        if ($request['publish'] == null) {
            $request['publish'] = 0;
        }
        $data = $request->all();

        $agenda->update([
            'title'                 => $data['title'],
            'description'           => $data['description'],
            'content'               => $data['content'],
            'image_content'         => $data['start']. ' - ' .$data['end'],
            'date'                  => $data['date'],
            'publish'               => $data['publish'],
        ]);

        return redirect()->route('agenda-fik.index');
    }

    public function destroy($agenda_feb)
    {
        $feb_agenda = ContentBerita::Find($agenda_feb);
        $feb_agenda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Agenda berhasil dihapus!'
        ],200);
    }
}
