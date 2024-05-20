<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('cars')
            ->orderBy('cars_count', 'desc')
            ->take(5)
            ->get();

        $brandCars = [];
        foreach ($brands as $brand) {
            $brandCars[] = [
                'brand' => $brand,
                'cars' => Car::where('brand_id', $brand->id)
                    ->where('active', 1)
                    ->with('brand', 'location', 'year', 'color')
                    ->take(4)
                    ->get(),
            ];
        }

        return view('home.index')
            ->with([
                'brandCars' => $brandCars,
            ]);
    }


    public function locale($locale)
    {
        if ($locale == 'en') {
            session()->put('locale', 'en');
            return redirect()->back();
        } elseif ($locale == 'tm') {
            session()->put('locale', 'tm');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
