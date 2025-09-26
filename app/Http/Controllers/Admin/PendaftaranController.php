<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentKemahasiswaan;
use App\Models\DetailContent;
use App\Models\Kemahasiswaan;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Str;
use File;
use RealRashid\SweetAlert\Facades\Alert;
class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $kemahasiswaan = Kemahasiswaan::where('category_kemahasiswaan_id', 4)->first();
        $pendaftaran = ContentKemahasiswaan::where('kemahasiswaan_id', $kemahasiswaan->id)->first();
        return view('admin.kemahasiswaan.pendaftaran.index', compact('pendaftaran'));
    }

    public function Update(Request $request, $pendataran_feb)
    {
        $pendaftaran = ContentKemahasiswaan::Find($pendataran_feb);
        $request->validate([
            'content'               => 'nullable',
        ]);

        if($request['content'] == null){
            $request['content'] = '#';
        }
        $data = $request->all();

           $pendaftaran->update([
                'content'               => $data['content'],
            ]);


        return redirect()->route('pendaftaran-fik.index');
    }

}
