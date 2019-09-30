<?php

namespace App\Http\Controllers;
use App\TesQuery;
use DB;

class TesQueryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        $data = DB::select( DB::raw("
          SELECT DISTINCT krs.id_mahasiswa, p.nama_penduduk, m.id_kelas, m.tahun_akademik, m.semester_masuk, ps.program_studi
          FROM krs
          INNER JOIN mahasiswa m ON m.id_mahasiswa = krs.id_mahasiswa
          INNER JOIN penduduk p ON m.id_penduduk = p.id_penduduk
          INNER JOIN program_studi ps ON ps.id_program_studi = m.id_program_studi"
        ));
        return response($data);
    }
    public function show($id){
        $data = TesQuery::where('id',$id)->get();
        return response ($data);
    }
    public function store (Request $request){
        $data = new TesQuery();
        $data->activity = $request->input('activity');
        $data->description = $request->input('description');
        $data->save();

        return response('Berhasil Tambah Data');
    }
    //
}
