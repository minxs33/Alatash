<?php

namespace App\Http\Controllers;

use App\Models\Carousels;
use App\Models\Categories;
use App\Models\Car_images;
use App\Models\Cars;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $carousels = Carousels::where('is_active', 1)->limit(4)->get();

        // $product_tshirt = Cars::with('car_images')->where('category_id', 2)->where('status', 'active')->withCount([
        //     'car_images',
        //     'car_images as car_images_count' => function ($query) {
        //         $query->where('is_active', '=', 1);
        //     }])->orderBy('cars.id', 'DESC')->limit(12)->get(['cars.*', 'cars.id as car_id', 'cars.name as car_name']);

        // $product_hoodie = Cars::with('car_images')->where('category_id', 3)->where('status', 'active')->withCount([
        //     'car_images',
        //     'car_images as car_images_count' => function ($query) {
        //         $query->where('is_active', '=', 1);
        //     }])->orderBy('cars.id', 'DESC')->limit(12)->get(['cars.*', 'cars.id as car_id', 'cars.name as car_name']);

        $categories = Categories::all();

        // $cars = Cars::with("car_images")->where("status","active")->withCount([
        // "car_images",
        // "car_images as car_images_count" => function ($query) {
            //     $query->where("is_active", "=", 1);
        // }])->orderBy("cars.id","DESC")->select(["cars.*", "cars.id as car_id","cars.name as car_name"])->paginate(30);

        // dd($cars->toArray());
        $query = Cars::with('car_images')->where('status', 'active')->orderBy('cars.id', 'DESC')->select(['cars.*', 'cars.id as car_id', 'cars.name as car_name']);

        if ($request->ajax()) {
            if ($request->category == 'all') {
                if ($request->min && $request->max) {
                    $query->where('price', '>=', $request->min)
                        ->where('price', '<=', $request->max);
                }
            } elseif ($request->category) {
                $query->where('category_id', $request->category);
                if ($request->min && $request->max) {
                    $query->where('price', '>=', $request->min)
                        ->where('price', '<=', $request->max);
                }
            }
            $cars = $query->paginate(8);

            return view('templates/includes/car-card', [
                'car' => $cars,
            ]);
        }
        $cars = $query->paginate(8);

        return view('landing', [
            'carousels' => $carousels,
            'car' => $cars,
            'categories' => $categories,
        ]);
    }

    public function search(Request $request)
    {
        $query = Cars::with('car_images')->where('status', 'active')->where('name', 'LIKE', '%'.$request->keyword.'%')->orderBy('cars.id', 'DESC')->select(['cars.*', 'cars.id as car_id', 'cars.name as car_name']);

        if ($request->ajax()) {
            if ($request->category == 'all') {
                if ($request->min && $request->max) {
                    $query->where('total_price', '>=', $request->min)
                        ->where('total_price', '<=', $request->max);
                }
            } elseif ($request->category) {
                $query->where('category_id', $request->category);
                if ($request->min && $request->max) {
                    $query->where('total_price', '>=', $request->min)
                        ->where('total_price', '<=', $request->max);
                }
            }
            $cars = $query->paginate(28);

            return view('templates/includes/product-card-search', [
                'car' => $cars,
            ]);
        }
        $cars = $query->paginate(28);

        $categories = Categories::all();

        return view('car-search', [
            'car' => $cars,
            'title' => $request->keyword,
            'categories' => $categories,
            'keyword' => $request->keyword,
        ]);
    }
}
