<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Color;
use App\Models\Location;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'brands' => 'nullable|array|min:0',
            'brands.*' => 'nullable|integer|min:1',
            'locations' => 'nullable|array|min:0',
            'locations.*' => 'nullable|integer|min:1',
            'years' => 'nullable|array|min:0',
            'years.*' => 'nullable|integer|min:1',
            'color' => 'nullable|integer|min:0',
            'sort' => 'nullable|string|in:new-to-old,old-to-new,low-to-high,high-to-low',
            'page' => 'nullable|integer|min:1',
            'perPage' => 'nullable|integer|in:15,30,60,120',
            'active' => 'nullable|boolean',
        ]);

        $f_brands = $request->has('brands') ? $request->brands : [];
        $f_locations = $request->has('locations') ? $request->locations : [];
        $f_years = $request->has('years') ? $request->years : [];
        $f_color = $request->has('color') ? $request->color : 0;
        $f_sort = $request->has('sort') ? $request->sort : null;
        $f_page = $request->has('page') ? $request->page : 1;
        $f_perPage = $request->has('perPage') ? $request->perPage : 15;
        $f_active = ($request->has('active') and auth()->check()) ? $request->active : 1;

        $cars = Car::when($f_brands, function ($query) use ($f_brands) {
            $query->whereIn('brand_id', $f_brands);
        })
            ->when($f_locations, function ($query) use ($f_locations) {
                $query->whereIn('location_id', $f_locations);
            })
            ->when($f_years, function ($query) use ($f_years) {
                $query->whereIn('year_id', $f_years);
            })
            ->when($f_color, function ($query) use ($f_color) {
                $query->where('color_id', $f_color);
            })
            ->where('active', $f_active)
            ->with('brand', 'location', 'year', 'color')
            ->when(isset($f_sort), function ($query) use ($f_sort) {
                if ($f_sort == 'old-to-new') {
                    $query->orderBy('id');
                } elseif ($f_sort == 'high-to-low') {
                    $query->orderBy('price', 'desc');
                } elseif ($f_sort == 'low-to-high') {
                    $query->orderBy('price');
                } else {
                    $query->orderBy('id', 'desc');
                }
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->paginate($f_perPage, ['*'], 'page', $f_page)
            ->withQueryString();

        $brands = Brand::orderBy('name')
            ->get();
        $locations = Location::orderBy('name')
            ->get();
        $years = Year::orderBy('name')
            ->get();
        $colors = Color::orderBy('name')
            ->get();

        return view('car.index')
            ->with([
                'cars' => $cars,
                'brands' => $brands,
                'locations' => $locations,
                'years' => $years,
                'colors' => $colors,
                'f_brands' => $f_brands,
                'f_locations' => $f_locations,
                'f_years' => $f_years,
                'f_color' => $f_color,
                'f_sort' => $f_sort,
                'f_perPage' => $f_perPage,
                'f_active' => $f_active,
            ]);
    }


    public function show($id)
    {
        $car = Car::when(!auth()->check(), function ($query) {
            $query->where('active', 1);
        })
            ->with('brand', 'location', 'year', 'color')
            ->findOrFail($id);

        $similar = Car::where('brand_id', $car->brand->id)
            ->where('location_id', $car->location->id)
            ->where('year_id', $car->year->id)
            ->where('active', 1)
            ->with('brand', 'location', 'year', 'color')
            ->take(4)
            ->get();

        return view('car.show')
            ->with([
                'car' => $car,
                'similar' => $similar,
            ]);
    }


    public function active(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ], Response::HTTP_OK);
        }

        $car = Car::findOrFail($request->id);
        $car->active = $car->active ? 0 : 1;
        $car->update();

        return response()->json([
            'status' => 0,
            'active' => $car->active,
        ], Response::HTTP_OK);
    }
}
