<?php

namespace App\Http\Controllers\Admin\Master;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Alert;
use App\Master\kotaModel;

class kotaController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.kota.page');
    }

    public function showForm()
    {
        return view('admin.master.kota.form');
    }

    public function store(Request $r)
    {
        $kota = kotaModel::where('kdKota', '=', $r->id)->firstOrFail();
        return view('admin.master.kota.update')->with(['kota' => $kota]);
    }
    //menampilkan data user
    public function getData()
    {
        $kota = kotaModel::query()
            ->select('kdKota', 'namaKota')
            ->get();

        return DataTables::of($kota)
            ->addIndexColumn()
            ->addColumn('action', function ($kota) {
                return '<a class="btn-sm btn-warning" data-toggle="tooltip" title="Ganti Data" id="btn-edit" href="/admin/kota/store?id=' . $kota->kdKota . '"><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $kota->kdKota . '\',event)"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'kdKota' => 'required|max:191|unique:tb_kota,kdKota',
            'namaKota' => 'required|max:191',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function add(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $kota = new kotaModel();
                $kota->kdKota = $r->kdKota;
                $kota->namaKota = $r->namaKota;
                $kota->save();
                Alert::success('Success', 'Berhasil Menambahkan Data');
                return redirect()->back();
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }

    private function isValidEdit(Request $r)
    {
        $messages = [];

        $rules = [
            'kdKota' => 'required|max:191|unique:tb_kota,kdKota,' . $r->kdKota . ',kdKota',
            'namaKota' => 'required|max:191',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }
    public function edit(Request $r)
    {
        if ($this->isValidEdit($r)->fails()) {
            $errors = $this->isValidEdit($r)->errors();
            Alert::error('Gagal Menambahkan Data', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $id = $r->oldusername;
                $data = [
                    'kdKota' => $r->kdKota,
                    'namaKota' => $r->namaKota,
                ];

                kotaModel::query()
                    ->where('kdKota', '=', $id)
                    ->update($data);
                Alert::success('Success', 'Berhasil Merubah Data');
                return redirect('/admin/kota');
            } catch (\Exception  $e) {
                $exData = explode('(', $e->getMessage());
                Alert::error('Gagal Merubah Data \n' . $exData[0], 'Ooops');
                return redirect()->back()->withInput();
            }
        }
    }


    public function delete(Request $r)
    {
        $id = $r->input('id');
        try {
            kotaModel::query()
                ->where('kdKota', '=', $id)
                ->delete();;
            return response()->json([
                'sukses' => 'Berhasil Di hapus' . $id,
                'sqlResponse' => true,
            ]);
        } catch (\Exception  $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'gagal' => 'Gagal Menghapus\n',
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }
}
