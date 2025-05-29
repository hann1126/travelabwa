<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageTourRequest;
use App\Http\Requests\UpdatePackageTourRequest;
use App\Models\Category;
use App\Models\PackagePhoto;
use App\Models\PackageTour;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $package_tours = PackageTour::orderByDesc('id')->paginate(10);
        return view('admin.package_tours.index', compact('package_tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::orderByDesc('id')->get();
        return view('admin.package_tours.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageTourRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            // Simpan thumbnail jika ada
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails/' . date('Y/m/d'), 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            // Buat slug
            $validated['slug'] = Str::slug($validated['name']);

            // Simpan data package tour
            $packageTour = PackageTour::create($validated);

            // Simpan photo-photo tambahan
            if ($request->hasFile('package_photos')) {
                foreach ($request->file('package_photos') as $photo) {
                    $photoPath = $photo->store('package_photos/' . date('Y/m/d'), 'public');

                    PackagePhoto::create([
                        'package_tour_id' => $packageTour->id,
                        'photo' => $photoPath
                    ]);
                }
            }

        });

        return redirect()->route('admin.package_tours.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(PackageTour $packageTour)
    {
        //
        $latestPhotos = $packageTour->package_photos()->orderByDesc('id')->take(3)->get();
        return view('admin.package_tours.show', compact('packageTour', 'latestPhotos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageTour $packageTour)
    {
        //
        $categories = Category::orderByDesc('id')->get();
        $latestPhotos = $packageTour->package_photos()->orderByDesc("id")->take(3)->get();
        return view('admin.package_tours.edit', compact('packageTour', 'latestPhotos', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageTourRequest $request, PackageTour $packageTour)
{
    DB::transaction(function () use ($request, $packageTour) {
        // Ambil data validasi dari form dan tambahkan slug
        $validated = array_merge(
            $request->validated(),
            ['slug' => Str::slug($request->name)]
        );

        // Simpan thumbnail jika diunggah
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails/' . date('Y/m/d'), 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        // Update data utama PackageTour
        $packageTour->update($validated);

        // Simpan foto-foto tambahan jika ada
        if ($request->hasFile('package_photos')) {
            foreach ($request->file('package_photos') as $photo) {
                $photoPath = $photo->store('package_photos/' . date('Y/m/d'), 'public');

                $packageTour->package_photos()->create([
                    'photo' => $photoPath,
                ]);
            }
        }
    });

    return redirect()->route('admin.package_tours.index')->with('success', 'Paket berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageTour $packageTour)
    {
        //
        DB::transaction(function () use ($packageTour) {
            $packageTour->delete();
        });

        return redirect()->route('admin.categories.index');
    }

}
