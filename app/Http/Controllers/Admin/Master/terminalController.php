<?php

namespace App\Http\Controllers\Admin\Master;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Alert;
use App\Master\kotaModel;
use App\Master\terminalModel;

class terminalController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.terminal.page');
    }

    public function showForm()
    {
        $kota = kotaModel::query()
            ->select('kdKota', 'namaKota')
            ->get();

        return view('admin.master.terminal.form')->with(['kota' => $kota]);
    }

    public function store(Request $r)
    {
        $kota = kotaModel::query()
            ->select('kdKota', 'namaKota')
            ->get();

        $terminal = terminalModel::where('kdTerminal', '=', $r->id)->firstOrFail();
        return view('admin.master.terminal.update')->with(['terminal' => $terminal, 'kota' => $kota]);
    }
    //menampilkan data user
    public function getData()
    {
        $terminal = terminalModel::query()
            ->join('tb_kota', 'tb_terminal.kdKota', '=', 'tb_kota.kdKota')
            ->select('kdTerminal', 'namaTerminal', 'tb_kota.namaKota')
            ->get();

        return DataTables::of($terminal)
            ->addIndexColumn()
            ->addColumn('action', function ($terminal) {
                return '<a class="btn-sm btn-warning" data-toggle="tooltip" title="Ganti Data" id="btn-edit" href="/admin/terminal/store?id=' . $terminal->kdTerminal . '"><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $terminal->kdTerminal . '\',event)"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'kdTerminal' => 'required|max:191|unique:tb_terminal,kdTerminal',
            'namaTerminal' => 'required|max:191',
            'kdKota' => 'required',
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
                $terminal = new terminalModel();
                $terminal->kdTerminal = $r->kdTerminal;
                $terminal->namaTerminal = $r->namaTerminal;
                $terminal->kdKota = $r->kdKota;
                $terminal->save();
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
            'kdTerminal' => 'required|max:191|unique:tb_terminal,kdTerminal,' . $r->kdTerminal . ',kdTerminal',
            'namaTerminal' => 'required|max:191',
            'kdKota' => 'required',
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
                    'kdTerminal' => $r->kdTerminal,
                    'namaTerminal' => $r->namaTerminal,
                    'kdKota' => $r->kdKota,
                ];

                terminalModel::query()
                    ->where('kdTerminal', '=', $id)
                    ->update($data);
                Alert::success('Success', 'Berhasil Merubah Data');
                return redirect('/admin/terminal');
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
            terminalModel::query()
                ->where('kdTerminal', '=', $id)
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
