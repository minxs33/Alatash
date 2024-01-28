<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy("id","ASC")->get();
        return view("admin/categories/categories-list", array(
            "categories" => $categories
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/categories/categories-insert");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name" => "required|min:3|max:100",
        ]);

        $categories = new Categories();
        $categories->name = $request->name;

        if($categories->save()){
            return redirect(url("admin/categories"))->with('success', 'Kategori telah berhasil ditambahkan!');
        }else{
            return redirect(url("admin/categories"))->with('error', 'Ada yang tidak beres, kategori gagal dimasukkan!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::find($id);
        return view("admin/categories/categories-update", array(
            "categories" => $categories
        ));
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
        $this->validate($request,[
            "name" => "required|min:3|max:100",
        ]);

        $categories = Categories::find($id);

        if($categories->update(["name" => $request->name])){
            return redirect(url("admin/categories"))->with('success', 'Kategori telah berhasil diperbarui!');
        }else{
            return redirect(url("admin/categories"))->with('error', 'Ada yang tidak beres, kategori gagal diperbarui!');
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
        $categories = Categories::find($id);

        if($categories->delete()){
            return redirect(url("admin/categories"))->with('success', 'Kategori telah berhasil dihapus!');
        }else{
            return redirect(url("admin/categories"))->with('error', 'Ada yang tidak beres, kategori gagal dihapus!');
        }
    }
}
