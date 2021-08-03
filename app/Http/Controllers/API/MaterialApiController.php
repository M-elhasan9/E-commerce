<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset=$request->input('offset',0);
        $limit=$request->input('limit',10);

        $materials = DB::table('materials')
            ->where('is_available','=',true)
            ->where('is_visible','=',true)
            ->offset($offset)->limit($limit)->get();

        return $materials;
    }

    public function getByCategory($categoryId,Request $request){

        //return all data of materials by category id
        $offset=$request->input('offset',0);
        $limit=$request->input('limit',10);
        $materials=Material::query()->whereHas('categories',function ($query) use ($categoryId) {
            $query->where('id',$categoryId);
        })->offset($offset)->limit($limit)->get();
        return $materials ;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $data = DB::table('materials')->where('id','=',$material['id'])->get();

        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }



}
