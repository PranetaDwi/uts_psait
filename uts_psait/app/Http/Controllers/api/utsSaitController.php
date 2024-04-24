<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class utsSaitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilai = DB::table('perkuliahan')
        ->join('mahasiswa', 'perkuliahan.nim', '=', 'mahasiswa.nim')
        ->join('matakuliah', 'perkuliahan.kode_mk', '=', 'matakuliah.kode_mk')
        ->select('mahasiswa.nim', 'mahasiswa.nama', 'matakuliah.kode_mk', 'matakuliah.nama_mk', 'perkuliahan.nilai')
        ->get();

        $response = [
            'message' => 'Data mahasiswa berhasil ditemukan',
            'data' => $nilai
        ];
        return response()->json($response);
    }

    public function indexByNim(Request $request)
    {

        $nim = $request->input('nim');
        $nilai = DB::table('perkuliahan')
        ->join('mahasiswa', 'perkuliahan.nim', '=', 'mahasiswa.nim')
        ->join('matakuliah', 'perkuliahan.kode_mk', '=', 'matakuliah.kode_mk')
        ->select('mahasiswa.nim','mahasiswa.nama', 'matakuliah.kode_mk', 'matakuliah.nama_mk', 'perkuliahan.nilai')
        ->where('mahasiswa.nim', $nim)
        ->get();

        $response = [
            'message' => 'Data mahasiswa berhasil ditemukan',
            'data' => $nilai
        ];
        return response()->json($response);
    }

    public function UpdateView(Request $request)
    {

        $nim = $request->input('nim');
        $kode_mk = $request->input('kode_mk');
        $nilai = DB::table('perkuliahan')
        ->join('mahasiswa', 'perkuliahan.nim', '=', 'mahasiswa.nim')
        ->join('matakuliah', 'perkuliahan.kode_mk', '=', 'matakuliah.kode_mk')
        ->select('mahasiswa.nim','mahasiswa.nama', 'matakuliah.kode_mk', 'matakuliah.nama_mk', 'perkuliahan.nilai')
        ->where('mahasiswa.nim', $nim)
        ->where('matakuliah.kode_mk', $kode_mk)
        ->get();

        $response = [
            'message' => 'Data mahasiswa berhasil ditemukan',
            'data' => $nilai
        ];
        return response()->json($response);
    }

    public function create(Request $request)
    {
        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $tanggal_lahir = $request->input('tanggal_lahir');

        DB::table('mahasiswa')->insert([
            'nim' => $nim,
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggal_lahir' => $tanggal_lahir,
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan'
        ]);
    }

    public function addNilai(Request $request){
        $nama = $request->input('nama');
        $mata_kuliah = $request->input('mata_kuliah');
        $nilai = $request->input('nilai');

        DB::table('perkuliahan')
        ->join('mahasiswa', 'perkuliahan.nim', '=', 'mahasiswa.nim')
        ->join('matakuliah', 'perkuliahan.kode_mk', '=', 'matakuliah.kode_mk')
        ->insert([
            'perkuliahan.nim' => DB::raw('(SELECT nim FROM mahasiswa WHERE nama = "' . $nama . '")'),
            'perkuliahan.kode_mk' => DB::raw('(SELECT kode_mk FROM matakuliah WHERE nama_mk = "' . $mata_kuliah . '")'),
            'nilai' => $nilai,
        ]);
        return response()->json(['message' => 'Data perkuliahan berhasil ditambahkan']);
        
    }

    public function update(Request $request)
    {
        $nim = $request->input('nim');
        $kode_mk = $request->input('kode_mk');
        $nilai_baru = $request->input('nilai');

        DB::table('perkuliahan')
        ->where('nim', $nim)
        ->where('kode_mk', $kode_mk)
        ->update(['nilai' => $nilai_baru]);

        return response()->json(['message' => 'Nilai berhasil diupdate']);
    
    }

    public function delete(Request $request)
    {
        $nim = $request->input('nim');
        $kode_mk = $request->input('kode_mk');

        DB::table('perkuliahan')
        ->where('nim', $nim)
        ->where('kode_mk', $kode_mk)
        ->delete();

        return response()->json(['message' => 'Nilai berhasil Hapus']);
    
    }
}
