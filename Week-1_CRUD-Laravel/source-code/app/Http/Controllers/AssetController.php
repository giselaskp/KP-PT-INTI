<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    $activeAsset = Asset::where('status', 'Active')->count();
    $maintenanceAsset = Asset::where('status', 'Maintenance')->count();
    $inactiveAsset = Asset::where('status', 'Inactive')->count();

    $assetCodes = Asset::pluck('asset_code', 'id');

    return view('dashboard', compact(
        'assets',
        'search',
        'totalAsset',
        'activeAsset',
        'maintenanceAsset',
        'inactiveAsset',
        'assetCodes'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'asset_code' => 'required|max:20|unique:assets,asset_code',
            'asset_name' => 'required|max:100',
            'department' => 'required|max:100',
            'location' => 'required|max:150',
            'status' => 'required|in:Active,Maintenance,Inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
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

            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $data = $request->only([
            'asset_code',
            'asset_name',
            'department',
            'location',
            'status',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        Asset::create($data);

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
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

            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'image.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $data = $request->only([ 'asset_code', 'asset_name', 'department', 'location', 'status']);
        if ($request->remove_image == "1") {
            if ($asset->image && Storage::disk('public')->exists($asset->image)) {
                Storage::disk('public')->delete($asset->image);
            }

            $data['image'] = null;
        }

        if ($request->hasFile('image')) {

            if ($asset->image && Storage::disk('public')->exists($asset->image)) {
                Storage::disk('public')->delete($asset->image);
            }

            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        $asset->update($data);

        return redirect('/dashboard?page=' . $request->query('page', 1))
            ->with('success', 'Asset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect('/dashboard?page=' . request()->query('page', 1))
            ->with('success', 'Asset berhasil dihapus.');
    }
}
