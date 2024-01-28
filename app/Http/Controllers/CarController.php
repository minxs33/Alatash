<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Car_images;
use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Cars::join('categories', 'cars.category_id', '=', 'categories.id')->join('users', 'cars.created_by', '=', 'users.id')->where('status', '!=', 'waiting')->select(['cars.*', 'cars.id as car_id', 'categories.name as cat_name', 'cars.name as car_name', 'users.name as users_name'])->orderBy('car_id', 'ASC')->withCount('Car_images')->get();

        $cars_waiting = Cars::where('status', '=', 'waiting')->count();

        // dd($cars_waiting);
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            return view('admin/cars/car-list', [
                'cars' => $cars,
                'cars_waiting' => $cars_waiting,
            ]);
        } elseif (Auth::user()->role == 3) {
            return view('admin/cars/cars-catalogue', [
                'cars' => $cars,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        return view('admin/cars/car-insert', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:3',
            'price' => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
        ]);

        $cars = new cars();
        $cars->category_id = $request->category_id;
        $cars->name = $request->name;
        $cars->description = $request->description;
        $cars->price = $request->price;
        $cars->discount = $request->discount;
        $cars->total_price = $request->price - (($request->price / 100) * $request->discount);
        $cars->status = $request->status == '1' ? 'active' : 'non-active';
        // if (Auth::user()->role == 1) {
        //     $cars->status = $request->status == '1' ? 'active' : 'non-active';
        // } elseif (Auth::user()->role == 2) {
        //     $cars->status = 'waiting';
        // }
        $cars->save();

        $imageFields = [];

        for ($i = 1; $i <= $request->image_count; ++$i) {
            $imageFields[] = 'image_'.$i;
            $imageStatus[] = 'image_status_'.$i;
        }

        // dd($request);
        foreach ($imageFields as $i => $field) {
            echo $field;
            if ($request->file($field)) {
                $validate_list = [
                    $field => 'image|mimes:png,jpg,jpeg|max:2048',
                ];

                $image_status = $imageStatus[$i];

                if ($this->validate($request, $validate_list)) {
                    $uploadedFile = $request->file($field);

                    $name = time().'-'.$uploadedFile->getClientOriginalName();
                    $name = str_replace(' ', '-', $name);
                    $name = str_replace('_', '-', $name);
                    $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
                    $name = preg_replace('/-+/', '-', $name);

                    Storage::putFileAs('public/images/car-images', $uploadedFile, $name);

                    Car_images::insert([
                        'cars_id' => $cars->id,
                        'image_url' => $name,
                        'is_active' => $request->$image_status == '1' ? 1 : 0,
                    ]);
                } else {
                    return redirect()->back()->with(['error' => 'Validasi gambar gagal, gambar harus dalam format png, jpg atau jpeg dan berukuran 2 MB atau kurang']);
                }
            }
        }

        return redirect(url('admin/cars'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cars = Cars::with('Car_images')->join('categories', 'cars.category_id', '=', 'categories.id')->select(['cars.*', 'categories.name as cat_name', 'cars.name as car_name'])->find($id);
        // dd($cars->toArray());

        $recommendation = Cars::with('Car_images')->where('category_id', $cars['category_id'])->where('status', 'active')->withCount([
            'Car_images',
            'Car_images as Car_images_count' => function ($query) {
                $query->where('is_active', '=', 1);
            }])->inRandomOrder()->limit(12)->get(['cars.*', 'cars.id as car_id', 'cars.name as car_name']);

        return view('car-show', [
            'title' => $cars->name,
            'cars' => $cars,
            'recommendation' => $recommendation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cars = Cars::join('categories', 'cars.category_id', '=', 'categories.id')->select(['cars.*', 'cars.id as car_id', 'cars.name as car_name', 'categories.name as cat_name', 'categories.id as cat_id'])->find($id);
        $categories = Categories::all();

        return view('admin/cars/car-update', [
            'car' => $cars,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:3',
            'price' => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            'discount' => 'integer',
        ]);

        $cars = Cars::find($id);
        $cars->category_id = $request->category_id;
        $cars->name = $request->name;
        $cars->description = $request->description;
        $cars->price = $request->price;
        $cars->discount = $request->discount;
        $cars->total_price = $request->price - (($request->price / 100) * $request->discount);
        $cars->status = $request->status != null ? 'active' : 'non-active';
        $cars->update();

        // dd($request);
        return redirect(url('admin/cars'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cars_images = Car_images::where('cars_id', $id)->get();
        foreach ($cars_images as $row) {
            Storage::delete('public/images/car-images/'.$row['image_url']);
        }
        Car_images::where('cars_id', $id)->delete();
        Cars::find($id)->delete();

        return redirect(url('admin/cars'));
    }

    public function getStatus(Request $request)
    {
        $id = $request->id;
        $cars = Cars::where('id', $id)->first(['status']);

        if ($cars) {
            if ($cars['status'] == 'active') {
                Cars::where('id', $id)->update(['status' => 'non-active']);
            } else {
                Cars::where('id', $id)->update(['status' => 'active']);
            }

            return response()->json(['message' => 'Sukses']);
        } else {
            return response()->json(['message' => 'Mobil tidak ditemukan'], 404);
        }
    }

    public function carConfirmation(Request $request)
    {
        $cars = Cars::join('categories', 'cars.category_id', '=', 'categories.id')->join('users', 'cars.created_by', '=', 'users.id')->where('status', '=', 'waiting')->select(['cars.*', 'cars.id as car_id', 'categories.name as cat_name', 'cars.name as car_name', 'users.name as users_name'])->orderBy('car_id', 'ASC')->withCount('Car_images')->get();

        if ($request->ajax()) {
            if ($request->get_cars_id) {
                $cars = Cars::with('Car_images')->join('categories', 'cars.category_id', '=', 'categories.id')->join('users', 'cars.created_by', '=', 'users.id')->select(['cars.*', 'cars.id as car_id', 'categories.name as cat_name', 'cars.name as car_name', 'users.name as users_name'])->find($request->get_cars_id);

                if ($cars) {
                    return response()->json($cars);
                } else {
                    return response()->json(['error' => 'Mobil tidak ditemukan'], 404);
                }
            } elseif ($request->approve_cars_id) {
                $cars = Cars::where('id', $request->approve_cars_id)->update([
                    'status' => 'non-active',
                ]);

                if ($cars) {
                    return response()->json($cars);
                } else {
                    return response()->json(['error' => 'Mobil tidak ditemukan'], 404);
                }
            } elseif ($request->deny_cars_id) {
                $cars_images = Car_images::where('cars_id', $request->deny_cars_id)->get();
                foreach ($cars_images as $row) {
                    Storage::delete('public/images/car-images/'.$row['image_url']);
                }
                Car_images::where('cars_id', $request->deny_cars_id)->delete();
                Cars::find($request->deny_cars_id)->delete();
            }

            return view('templates/includes/car-admin-card', [
                'cars' => $cars,
            ]);
        }

        return view('admin/cars/car-confirmation', [
            'cars' => $cars,
        ]);
    }
}
