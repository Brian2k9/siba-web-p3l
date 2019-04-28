<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jasa_service;

class jasaservicecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jasas = jasa_service::paginate(10);

        return response()->json($jasas, 200);
    }

    public function all()
    {
        $jasas = jasa_service::all();

        return response()->json($jasas, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
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
            'nama_jasa' => 'required|unique:jasa_services,nama_jasa|max:255',
            
        ]);

        $jasa = new jasa_service;
        $jasa->nama_jasa = $request->nama_jasa;
        $jasa->harga_jasa = $request->harga_jasa;
        
        $success = $jasa->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 201);
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
        //return jasa_service::where('nama_jasa', $nama_jasa)->first();

        $result = jasa_service::find($id);

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }

    public function search(Request $request)
    {
        //return jasa_service::where('nama_jasa', $nama_jasa)->first();
        $search = $request->get('q');
        return jasa_service::where('nama_jasa', 'like', '%'.$search.'%')->get();


        // if (is_null($result)) {
        //     return response()->json('Not Found', 404);
        // } else
        //     return response()->json($result, 200);
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
            'nama_jasa' => 'required|unique:jasa_services,nama_jasa,'.$id.'|max:255',
            ]);

        $jasa = jasa_service::where('id', $id)->first();

        if (is_null($jasa)) {
            return response()->json('Jasa Service not found', 404);
        }

        else {
            $jasa->nama_jasa = $request->nama_jasa;
            $jasa->harga_jasa = $request->harga_jasa;

            $success = $jasa->save();

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
        $jasa = jasa_service::find($id);

        if(is_null($jasa)) {
            return response()->json('Jasa Service Not Found', 404);
        }
        
        else {
            $success = $jasa->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }

    /////////////////////////////////////////////////////////////////////// MOBILE

    public function indexMobile()
    {
        $jasas = jasa_service::all();

        return response()->json($jasas, 200);
    }
}
