<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car_images;
use App\Models\Cars;
use Illuminate\Support\Facades\Storage;

class Car_imageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cars = Cars::join("categories","cars.category_id","=","categories.id")->where("cars.id",$id)->first(["*","cars.id as car_id","categories.name as cat_name","cars.name as car_name"]);

        return view ("admin/car-images/car-image-insert", array(
            "cars" =>  $cars,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageFields = [];

        for ($i = 1; $i <= $request->image_count; $i++) {
            $imageFields[] = "image_".$i;
        }

        foreach ($imageFields as $field) {
            echo $field;
            if ($request->file($field)) {
                $validate_list = [
                    $field => "image|mimes:png,jpg,jpeg|max:2048",
                ];
        
                if($this->validate($request,$validate_list)){
                    $uploadedFile = $request->file($field);
                    $name = time().'-'.$uploadedFile->getClientOriginalName();
                    Storage::putFileAs('public/images/car-images', $uploadedFile, $name);
            
                    Car_images::insert([
                        "cars_id" => $request->cars_id,
                        "image_url" => $name,
                        "is_active" => 0
                    ]);
                }else{
                    return redirect()->back()->with(["error" => "Validasi gambar gagal, gambar harus dalam format png, jpg atau jpeg dan berukuran 2 MB atau kurang"]);
                }
        
               
            }
        }

        return redirect(url("admin/cars"));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car_images = Car_images::find($id);

        $old_image = $car_images::find($id)->image_url;
        Storage::delete("public/images/car-images/".$old_image);
        // unlink("public/images/product-images/".$old_image);        
        $car_images->delete();
        return response()->json($car_images);

        // $cars_id = Cars::where("id",$requ)
    }

    public function getCarImage(Request $request){
        $id = $request->id;
        $car_images = Car_images::where("cars_id", $id)->get();
        
        if ($car_images) {
            return response()->json($car_images);
        } else {
            return response()->json(["message" => "Mobil tidak ditemukan"], 404);
        }
    
    }

    public function updateIsActive(Request $request){
        $id = $request->id;
        $car_images = Car_images::where("id", $id)->first(['is_active']);
        
        if ($car_images) {
            if ($car_images['is_active'] == 0) {
                Car_images::where("id",$id)->update(["is_active" => 1]);
            } else {
                Car_images::where("id",$id)->update(["is_active" => 0]);
            }
            return response()->json(["message" => "success"]);
        } else {
            return response()->json(["message" => "Mobil tidak ditemukan"], 404);
        }

            
    }
}
