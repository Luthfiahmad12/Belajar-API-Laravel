<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = array("data" => Mahasiswa::all());
        return response()->json($output);
        // $data = Mahasiswa::all();
        // if ($data) {
        //     return ApiFormatter::createApi(200, 'success', $data);
        // } else {
        //     return ApiFormatter::createApi(400, 'failed');
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        try {
            $validasi = $request->validate(
                [
                    'nama' => 'required',
                    'nim' => 'required',
                    'alamat' => 'required',
                    'telp' => 'required',
                ]
            );
            $data = Mahasiswa::create($validasi);
            if ($data) {
                return ApiFormatter::createApi(200, 'success', $data);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception) {
            return ApiFormatter::createApi(400, 'failed',);
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
        $data = [Mahasiswa::where('id', $id)->get()]; //('id',$id ) artinya id adalah/sama dengan $id
        if ($data) {
            return ApiFormatter::createApi(200, 'success', $data);
        } else {
            return ApiFormatter::createApi(400, 'failed');
        }
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
        try {
            $validasi = $request->validate(
                [
                    'nama' => 'required',
                    'nim' => 'required',
                    'alamat' => 'required',
                    'telp' => 'required',
                ]
            );
            $data = Mahasiswa::findOrFail($id);
            $data->update($validasi);
            $data = Mahasiswa::where('id', $id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, 'success', $data);
            } else {
                return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception) {
            return ApiFormatter::createApi(400, 'failed',);
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
        $mahasiswa = Mahasiswa::findOrfail($id);

        $data = $mahasiswa::where('id', $id)->delete(); //karena model di mahasiswa static

        if ($data) {
            return ApiFormatter::createApi(200, 'success Destroy Data');
        } else {
            return ApiFormatter::createApi(400, 'failed');
        }
    }
}
