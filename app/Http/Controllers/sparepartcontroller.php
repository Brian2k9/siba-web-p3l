<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sparepart;

class sparepartcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spareparts = Sparepart::paginate(10);

        return response()->json($spareparts, 200);
    }

    public function all()
    {
        $spareparts = Sparepart::all();

        return response()->json($spareparts, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'kode_sparepart' => 'required|unique:spareparts,kode_sparepart|max:255',
            'jumlah_stok_sparepart' => 'required|numeric|not_in:0|min:0',
            'harga_beli_sparepart' => 'required|numeric|not_in:0|min:0',
            'harga_jual_sparepart' => 'required|numeric|not_in:0|min:0',
            'jumlah_minimal' => 'required|numeric|not_in:0|min:0',
            
        ]);
            
        $exploded = explode(',', $request->gambar_sparepart);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg'))
          $extention = 'jpg';
        else
          $extention = 'png';
  
        $fileName = str_random() .'.'. $extention;
        $path = public_path() . '/images/sparepart/' . $fileName;
        file_put_contents($path, $decoded);

        $sparepart = new sparepart;

        $sparepart->kode_sparepart = $request->kode_sparepart;
        $sparepart->nama_sparepart = $request->nama_sparepart;
        $sparepart->merk_sparepart = $request->merk_sparepart;  
        $sparepart->tipe_sparepart = $request->tipe_sparepart;
        $sparepart->gambar_sparepart = $fileName;
        $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
        $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
        $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
        $sparepart->jumlah_minimal = $request->jumlah_minimal;

        /*
        if($request->hasFile('gambar_sparepart')){ //gambar_sparepart itu nama variabel dari model
            $dir = 'uploads/';
            $path = 'https://localhost:180/uploads/'; //sesuai path yang dipake
            $extension = strtolower($request->file('gambar_sparepart')->getClientOriginalExtension());
            $fileName = str_random() . '.' . $extension;
            $file = $path . $fileName;
            $request->file('gambar_sparepart')->move($dir, $fileName);
            $sparepart->gambar_sparepart = $file;
        }
        */

        // $sparepart = new sparepart;
        // $sparepart->kode_sparepart = $request->kode_sparepart;
        // $sparepart->nama_sparepart = $request->nama_sparepart;
        // $sparepart->merk_sparepart = $request->merk_sparepart;  
        // $sparepart->tipe_sparepart = $request->tipe_sparepart;
        // $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
        // $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
        // $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
        // $sparepart->jumlah_minimal = $request->jumlah_minimal;
        
        // if($request->hasFile('gambar_sparepart')){ //gambar_sparepart itu nama variabel dari model
        //     $dir = 'images/sparepart/';
        //     $path = 'http://127.0.0.1:8000/images/sparepart/'; //sesuai path yang dipake
        //     $extension = strtolower($request->file('gambar_sparepart')->getClientOriginalExtension());
        //     $fileName = str_random() . '.' . $extension;
        //     $file = $path . $fileName;
        //     $request->file('gambar_sparepart')->move($dir, $fileName);
        //     $sparepart->gambar_sparepart = $file;
        // }

        $success = $sparepart->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

        $result = Sparepart::find($id);

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }
    
    public function showByName($nama_sparepart)
    {
        //return sparepart::where('nama_sparepart', $nama_sparepart)->first();

        $result = Sparepart::where('nama_sparepart', 'like', "%".$nama_sparepart."%")->get();

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $request->validate([
            'kode_sparepart' => 'required|unique:spareparts,kode_sparepart,'.$id.'|max:255',
            'jumlah_stok_sparepart' => 'required|numeric|not_in:0|min:0',
            'harga_beli_sparepart' => 'required|numeric|not_in:0|min:0',
            'harga_jual_sparepart' => 'required|numeric|not_in:0|min:0',
            'jumlah_minimal' => 'required|numeric|not_in:0|min:0',
            ]);

        $sparepart = Sparepart::where('id', $id)->first();

        if (is_null($sparepart)) {
            return response()->json('Sparepart not found', 404);
        }

        else {
            
                

                if(is_null($sparepart->gambar_sparepart)){
                    $sparepart->kode_sparepart = $request->kode_sparepart;
                    $sparepart->nama_sparepart = $request->nama_sparepart;
                    $sparepart->merk_sparepart = $request->merk_sparepart;
                    $sparepart->tipe_sparepart = $request->tipe_sparepart;
                    $sparepart->gambar_sparepart = $request->gambar_sparepart;
                    $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
                    $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
                    $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
                    $sparepart->jumlah_minimal = $request->jumlah_minimal;
                }
                else{
                    $exploded = explode(',', $request->gambar_sparepart);
                    $decoded = base64_decode(isset($exploded[1]) ? $exploded[1] : null);
                    if(str_contains($exploded[0], 'jpeg'))
                    $extention = 'jpg';
                    else
                    $extention = 'png';
          
                    $fileName = str_random() .'.'. $extention;
                    $path = public_path() . '/images/sparepart/' . $fileName;
                    file_put_contents($path, $decoded);

                    $sparepart->kode_sparepart = $request->kode_sparepart;
                    $sparepart->nama_sparepart = $request->nama_sparepart;
                    $sparepart->merk_sparepart = $request->merk_sparepart;
                    $sparepart->tipe_sparepart = $request->tipe_sparepart;
                    $sparepart->gambar_sparepart = $fileName;
                    $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
                    $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
                    $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
                    $sparepart->jumlah_minimal = $request->jumlah_minimal;

                }

                
            // $sparepart->kode_sparepart = $request->kode_sparepart;
            // $sparepart->nama_sparepart = $request->nama_sparepart;
            // $sparepart->merk_sparepart = $request->merk_sparepart;
            // $sparepart->tipe_sparepart = $request->tipe_sparepart;
            // $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
            // $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
            // $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
            // $sparepart->jumlah_minimal = $request->jumlah_minimal;
            // if($request->hasFile('gambar_sparepart')){ //gambar_sparepart itu nama variabel dari model
            //     $dir = 'images/sparepart/';
            //     $path = 'http://127.0.0.1:8000/images/sparepart/'; //sesuai path yang dipake
            //     $extension = strtolower($request->file('gambar_sparepart')->getClientOriginalExtension());
            //     $fileName = str_random() . '.' . $extension;
            //     $file = $path . $fileName;
            //     $request->file('gambar_sparepart')->move($dir, $fileName);
            //     $sparepart->gambar_sparepart = $file;
            // }

            $success = $sparepart->save();

            if (!$success) {
                return response()->json('Error Updating', 500);
            } else {
                return response()->json('Success Updating', 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sparepart = Sparepart::find($id);

        if(is_null($sparepart)) {
            return response()->json('Sparepart Not Found', 404);
        }
        
        else {
            $success = $sparepart->delete();
            if($success)
                return response()->json('Success Delete', 204);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }

    private $photo_path;
    public function __construct() {
        $this->photo_path = 'http://192.168.1.27:8000/images/sparepart/';
    }

    public function indexMobile()
    {
        $spareparts = Sparepart::all();
        return response()->json($spareparts, 200);
    }


    public function storeMobile(Request $request)
    {
        $sparepart = new sparepart;

        $kode_spare = $request->kode_sparepart;

        $no = Sparepart::where('kode_sparepart', 'like', $kode_spare.'%')
                ->orderBy('kode_sparepart', 'desc')->pluck('kode_sparepart')->first();
        if(!$no) {
            $no = '001';
            $sparepart->kode_sparepart = $kode_spare.$no;
        }
        else {
            $sparepart->kode_sparepart = ++$no;
        }

        
        $sparepart->nama_sparepart = $request->nama_sparepart;
        $sparepart->merk_sparepart = $request->merk_sparepart;  
        $sparepart->tipe_sparepart = $request->tipe_sparepart;
        // $sparepart->gambar_sparepart = $request->gambar_sparepart;
        $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
        $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
        $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
        $sparepart->jumlah_minimal = $request->jumlah_minimal;
        
        if($request->hasFile('gambar_sparepart')){ //gambar_sparepart itu nama variabel dari model
            $dir = 'images/sparepart/';
            $extension = strtolower($request->file('gambar_sparepart')->getClientOriginalExtension());
            $fileName = str_random() . '.' . $extension;
            $file = $this->photo_path . $fileName;
            $request->file('gambar_sparepart')->move($dir, $fileName);
            $sparepart->gambar_sparepart = $file;
        }
        
        $success = $sparepart->save();
        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
    }

    public function updateMobile(Request $request, $id)
    {
        $sparepart = Sparepart::where('id', $id)->first();
        if (is_null($sparepart)) {
            return response()->json('Sparepart not found', 404);
        }
        else {
            $sparepart->kode_sparepart = $request->kode_sparepart;
            $sparepart->nama_sparepart = $request->nama_sparepart;
            $sparepart->merk_sparepart = $request->merk_sparepart;
            $sparepart->tipe_sparepart = $request->tipe_sparepart;
            $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
            $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
            $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
            $sparepart->jumlah_minimal = $request->jumlah_minimal;
            if($request->hasFile('gambar_sparepart')){ //gambar_sparepart itu nama variabel dari model
                $dir = 'images/sparepart/';
                // $path = 'http://10.53.10.70:8000/images/sparepart/'; //sesuai path yang dipake
                $extension = strtolower($request->file('gambar_sparepart')->getClientOriginalExtension());
                $fileName = str_random() . '.' . $extension;
                $file = $this->photo_path . $fileName;
                $request->file('gambar_sparepart')->move($dir, $fileName);
                $sparepart->gambar_sparepart = $file;
            }
            $success = $sparepart->save();
            if (!$success) {
                return response()->json('Error Updating', 500);
            } 
            else {
                return response()->json('Success Updating', 204);
            }
        }
    }

    public function updateMobileNonImage(Request $request, $id)
    {
        $sparepart = Sparepart::where('id', $id)->first();
        if (is_null($sparepart)) {
            return response()->json('Sparepart not found', 404);
        }
        $sparepart->kode_sparepart = $request->kode_sparepart;
        $sparepart->nama_sparepart = $request->nama_sparepart;
        $sparepart->merk_sparepart = $request->merk_sparepart;
        $sparepart->tipe_sparepart = $request->tipe_sparepart;
        $sparepart->jumlah_stok_sparepart = $request->jumlah_stok_sparepart;
        $sparepart->harga_beli_sparepart = $request->harga_beli_sparepart;
        $sparepart->harga_jual_sparepart = $request->harga_jual_sparepart;
        $sparepart->jumlah_minimal = $request->jumlah_minimal;
            
        $success = $sparepart->save();
        if (!$success) {
            return response()->json('Error Updating', 500);
        } 
        else {
            return response()->json('Success Updating', 204);
        }
    }

    public function cekJumlahStok() {
        $results = Sparepart::whereColumn('jumlah_stok_sparepart', '<=', 'jumlah_minimal')->get();

        if(is_null($results)) {
            return response()->json('Not found', 404);
        }
        else {
            return response()->json($results, 200);
        }
    }
}
