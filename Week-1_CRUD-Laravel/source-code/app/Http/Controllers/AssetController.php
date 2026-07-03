<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $assets = Asset::when($search, function ($query) use ($search) {
        $query->where('asset_code', 'like', "%{$search}%")
              ->orWhere('asset_name', 'like', "%{$search}%")
              ->orWhere('department', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
    })
    ->latest()
    ->paginate(5)
    ->withQueryString();

    $totalAsset = Asset::count();
    $totalDepartment = Asset::distinct('department')->count('department');
    $activeAsset = Asset::where('status', 'Active')->count();
    $maintenanceAsset = Asset::where('status', 'Maintenance')->count();

    return view('dashboard', compact(
        'assets',
        'search',
        'totalAsset',
        'totalDepartment',
        'activeAsset',
        'maintenanceAsset'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'asset_code' => 'required|unique:assets,asset_code',
            'asset_name' => 'required',
            'department' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        Asset::create($request->all());

        return redirect('/dashboard')->with('success', 'Asset berhasil ditambahkan.');
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_code' => 'required|unique:assets,asset_code,' . $asset->id,
            'asset_name' => 'required',
            'department' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        $asset->update($request->all());

        return redirect('/dashboard')->with('success', 'Asset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect('/dashboard')->with('success', 'Asset berhasil dihapus.');
    }
}
