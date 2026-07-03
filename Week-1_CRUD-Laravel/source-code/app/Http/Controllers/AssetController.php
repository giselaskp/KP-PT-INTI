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
    $assetCodes = Asset::pluck('asset_code', 'id');

    return view('dashboard', compact(
        'assets',
        'search',
        'totalAsset',
        'totalDepartment',
        'activeAsset',
        'maintenanceAsset',
        'assetCodes'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'asset_code' => 'required|max:20|unique:assets,asset_code',
            'asset_name' => 'required|max:100',
            'department' => 'required|max:20',
            'location' => 'required|max:20',
            'status' => 'required|in:Active,Maintenance,Inactive',
        ], [
            'asset_code.required' => 'Asset code wajib diisi.',
            'asset_code.unique' => 'Asset code sudah digunakan.',
            'asset_code.max' => 'Asset code maksimal 20 karakter.',

            'asset_name.required' => 'Nama asset wajib diisi.',
            'asset_name.max' => 'Nama asset maksimal 100 karakter.',

            'department.required' => 'Department wajib diisi.',
            'department.max' => 'Department maksimal 100 karakter.',

            'location.required' => 'Location wajib diisi.',
            'location.max' => 'Location maksimal 150 karakter.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        Asset::create($request->all());

        return redirect('/dashboard')->with('success', 'Asset berhasil ditambahkan.');
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_code' => 'required|max:20|unique:assets,asset_code,' . $asset->id,
            'asset_name' => 'required|max:100',
            'department' => 'required|max:100',
            'location' => 'required|max:150',
            'status' => 'required|in:Active,Maintenance,Inactive',
        ], [
            'asset_code.required' => 'Asset code wajib diisi.',
            'asset_code.unique' => 'Asset code sudah digunakan.',
            'asset_code.max' => 'Asset code maksimal 20 karakter.',

            'asset_name.required' => 'Nama asset wajib diisi.',
            'asset_name.max' => 'Nama asset maksimal 100 karakter.',

            'department.required' => 'Department wajib diisi.',
            'department.max' => 'Department maksimal 100 karakter.',

            'location.required' => 'Location wajib diisi.',
            'location.max' => 'Location maksimal 150 karakter.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
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
