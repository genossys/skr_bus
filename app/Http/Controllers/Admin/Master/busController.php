<?php

namespace App\Http\Controllers\Admin\Master;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Alert;
use App\Master\busModel;

class busController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.bus.page');
    }

    public function showForm()
    {
        return view('admin.master.bus.form');
    }

    public function store(Request $r)
    {
        $bus = busModel::where('kdBus', '=', $r->id)->firstOrFail();
        return view('admin.master.bus.update')->with(['bus' => $bus]);
    }
    //menampilkan data user
    public function getData()
    {
        $bus = busModel::query()
            ->select('kdBus', 'namaBus', 'kursi')
            ->get();

        return DataTables::of($bus)
            ->addIndexColumn()
            ->addColumn('action', function ($bus) {
                return '<a class="btn-sm btn-warning" data-toggle="tooltip" title="Ganti Data" id="btn-edit" href="/admin/bus/store?id=' . $bus->kdBus . '"><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $bus->kdBus . '\',event)"><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'kdBus' => 'required|max:191|unique:tb_bus,kdBus',
            'namaBus' => 'required|max:191',
            'kursi' => 'required',
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
                $bus = new busModel();
                $bus->kdBus = $r->kdBus;
                $bus->namaBus = $r->namaBus;
                $bus->kursi = $r->kursi;
                $bus->save();
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
            'kdBus' => 'required|max:191|unique:tb_bus,kdBus,' . $r->kdBus . ',kdBus',
            'namaBus' => 'required|max:191',
            'kursi' => 'required',
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
                    'kdBus' => $r->kdBus,
                    'namaBus' => $r->namaBus,
                    'kursi' => $r->kursi
                ];

                busModel::query()
                    ->where('kdBus', '=', $id)
                    ->update($data);
                Alert::success('Success', 'Berhasil Merubah Data');
                return redirect('/admin/bus');
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
            busModel::query()
                ->where('kdBus', '=', $id)
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
