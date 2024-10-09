<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Po_Barang;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function buku()
    {
        return view('admin.buku');
    }

    public function buku_det(Request $request)
    {
        if ($request->ajax()){
            $data = DB::table('po_barang')->select('nama_barang', 'satuan', 'jumlah', 'harga_satuan', 'keterangan');
            return Datatables::of($data)
            ->make(true);
        } else {
            return 'Something went wrong!';
        }
    }

    public function buku_store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            // dd($data);

            $insertPO = [
                'nama_barang' => $data['nama_barang'],
                'satuan' => $data['satuan'],
                'jumlah' => $data['jumlah'],
                'harga_satuan' => $data['harga_satuan'],
                'keterangan' => $data['keterangan']
            ];
            DB::table('po_barang')->insert($insertPO);

            DB::commit();
            return response()->json([
                'status' => 1,
                'msg' => 'Data berhasil disimpan!'
            ]);

        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, silakan coba lagi!'
            ]);
        }
    }

    # untuk soal no. 3
    public function get_data(Request $request)
    {
        $data = [
            'STATUS' => 1,
            'ID' => 'MDP00255',
            'refid' => '101310310401',
            'name' => 'Dwi Purwani',
            'branch' => '1010',
            'TAXID' => '58.199.411.8-902.000'
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully.',
            'data' => $data
        ]);
    }

    public function edit_buku(Request $request, $id)
    {
        return view('admin.detailBuku');
    }
}
