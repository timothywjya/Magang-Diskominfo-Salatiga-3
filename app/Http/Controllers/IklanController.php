<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Iklan;

use Carbon\Carbon;

use Auth;

class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = '')
    {
         return view('iklan', compact('status'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataIklan($status = '')
    {
        if($status == 'setor') $data = Iklan::Where('status', 'setor')->get();
        else if($status == 'belum') $data = Iklan::Where('status', 'belum')->get();
        else $data = Iklan::all();
        return Datatables::of($data)
            ->addColumn('aksi', function($data){
            return ' <center>
            <a href="'.route('edit', ['id' => $data->id]).'" class="btn btn-success"><i class="nav-icon fas fa-edit"></i> Ubah</a>
            <a class="btn btn-danger" onclick="return myFunction();" href="'.route('delete', ['id' => $data->id]).'"><i class="fa fa-trash"></i> Hapus</a>
            <a href="'.route('cetakPerTransaksi', ['id' => $data->id, 'tanggal' => $data->tanggal->format('Ymd')]).'" target="_blank" class="btn btn-primary"><i class="nav-icon fas fa-print"></i> cetak</a>
            </center>';
        })
            ->editColumn('status', function ($data){
            if ($data->status == 'belum'){
                return 'Belum Disetor';
            } if ($data->status == 'setor'){
                return 'Sudah Disetor';
            } else{
                return 'error';
            }
        })
            ->editColumn('metode_pembayaran', function ($data){
            return ucwords($data->metode_pembayaran);
        })
            ->editColumn('tanggal', function ($data){
            return [
                'display' => Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y'),
                'fungsi_sorting' => $data->tanggal
         ];
        })
            ->addColumn('tanggal2', function($data){
            return $data->tanggal->format('Ymd');
        })
            ->editColumn('tanggal_setor', function ($data){
            if ($data->tanggal_setor == null) {
                return '-';
            }
                return Carbon::parse($data->tanggal_setor)->isoFormat('dddd, D MMMM Y');
        })
            ->editColumn('jumlah', function ($data){
            return number_format($data->jumlah, 0, ',', '.');
        })
            ->editColumn('nomor_dokumen', function ($data){
            return $data->nomor_dokumen ?? '-';
        })
            ->editColumn('nomor_billing', function ($data){
            return $data->nomor_billing ?? '-';
        })
            ->addColumn('operator', function($data){
            return $data->user->name;
        })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    public function draftSetor(Request $req)
    {
        $ids=explode(',', $req->id);
        $data =  Iklan::whereIn('id', $ids)->get();
        return view('setor', ['data' => $data, 'ids' => $req->id]);
    }
    public function setor(Request $request){
        $ids = explode(',', $request->ids);
        Iklan::whereIn('id', $ids)->update(
            [
                'nomor_dokumen' => $request->nomor_dokumen,
                'nomor_billing' => $request->nomor_billing,
                'tanggal_setor' => $request->tanggal_setor,
                'status' => 'setor'
            ]
        );
        $request->session()->flash('message1');
        return redirect('/iklan');
    }
    public function create()
    {
        $nomorTerakhir = Iklan::select('nomor')->orderBy('nomor', 'desc')->first()->nomor + 1;
        return view('tambah', compact('nomorTerakhir'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setoran()
    {
        $data = Iklan::select('nomor_dokumen','nomor_billing','tanggal_setor')->selectRaw('SUM(jumlah) as jumlah')->groupBy('nomor_dokumen')->groupBy('nomor_billing')->groupBy('tanggal_setor')->where('status','setor')->get();
        return Datatables::of($data)
            ->addColumn('aksi', function($data){
            return ' <center>
            <a href="'.route('cetak', ['nomor_dokumen' => $data->nomor_dokumen,'nomor_billing' => $data->nomor_billing, 'tanggal_setor' => $data->tanggal_setor->format('Ymd')]).'" target="_blank" class="btn btn-primary"><i class="nav-icon fas fa-print"></i> Cetak</a>
            <a href="'.route('detail', ['nomor_dokumen' => $data->nomor_dokumen,'nomor_billing' => $data->nomor_billing,'tanggal_setor' => $data->tanggal_setor->format('Ymd')]).'"  class="btn btn-info"><i class="fa fa-info"></i> Detail</a>
            </center>';
        })
            ->editColumn('tanggal_setor', function ($data){
            if ($data->tanggal_setor == null) {
                return '-';
            }
                return Carbon::parse($data->tanggal_setor)->isoFormat('dddd, D MMMM Y');
        })
            ->editColumn('jumlah', function ($data){
            return number_format($data->jumlah,0, ',', '.');;
        })
            ->editColumn('nomor_dokumen', function ($data){
            if ($data->nomor_dokumen == '0') {
                return '-';
            }
               return $data->nomor_dokumen; 
        })
            ->editColumn('nomor_billing', function ($data){
            if ($data->nomor_billing == '0') {
                return '-';
            }
               return $data->nomor_billing;
        })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    public function store(Request $request)
    {
        Iklan::insert([
            'nomor' => $request->nomor,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jumlah' => str_replace('.', '', $request->jumlah),
            'metode_pembayaran' => $request->metodePembayaran,
            'user_id' => Auth::user()->id
        ]);
        $request->session()->flash('message1');
        return redirect('iklan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_iklan = Iklan::findOrFail($id);
        return view('ubah', ['data_iklan' => $data_iklan]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Iklan::find($id)->update([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jumlah' => str_replace('.', '', $request->jumlah),
            'metode_pembayaran' => $request->metodePembayaran
        ]);
        $request->session()->flash('message1');
        return redirect('iklan');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Iklan::where('id', $id)->delete();
        $request->session()->flash('message2');
        return redirect('iklan');
    }
    public function detail(Request $req)
    {
        $nomor_dokumens = explode(',', $req->nomor_dokumen);
        $nomor_billings = explode(',', $req->nomor_billing);
        $tanggal_setors = explode(',', $req->tanggal_setor);
        $data =  Iklan::where('nomor_dokumen',$nomor_dokumens)->where('nomor_billing',$nomor_billings)->where('tanggal_setor',$tanggal_setors)->get();
        return view('detail',['data' => $data, 'nomor_dokumens' => $req->nomor_dokumen]);
    }
    public function cetak(Request $req)
    {
        $nomor_dokumens = explode(',', $req->nomor_dokumen);
        $nomor_billings = explode(',', $req->nomor_billing);
        $tanggal_setors = explode(',', $req->tanggal_setor);
        $total = 0; 
        $data = Iklan::where('nomor_dokumen',$nomor_dokumens)->where('nomor_billing',$nomor_billings)->where('tanggal_setor',$tanggal_setors)->get();
        if(!$data->count()) return abort(403);
        return view('cetak', compact('data', 'total'));
    }
    public function profile(){
        return view('profile');
    }
    public function cetakPerTransaksi($id, $tanggal)
    {
        $data = Iklan::where('id',$id)->where('tanggal',$tanggal)->get();
        if(!$data->count()) return abort(403);
        return view('cetakpertransaksi', compact('data'));
    }
}
