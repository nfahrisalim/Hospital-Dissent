<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineManagementController extends Controller
{
    /**
     * Display a listing of all medicines.
     */
    public function index()
    {
        $medicines = Medicine::all();
        return view('Admin.Medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new medicine.
     */
    public function create()
    {
        return view('Admin.Medicines.create');
    }

    /**
     * Store a newly created medicine in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:keras,biasa', // validasi untuk 'type'
            'quantity' => 'required|integer|min:1',
            'expiration_date' => 'required|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi gambar
        ]);

        // Menyimpan data obat ke database
        $medicineData = [
            'name' => $request->name,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'expiration_date' => $request->expiration_date,
        ];

        // Jika ada gambar, simpan gambar dan tambahkan path-nya ke data obat
        if ($request->hasFile('image')) {
            $medicineData['image'] = Medicine::storeImage($request->file('image'));
        }

        Medicine::create($medicineData);

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine created successfully.');
    }

    /**
     * Show the form for editing a medicine.
     */
    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('Admin.Medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified medicine in storage.
     */
    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:keras,biasa', // validasi untuk 'type'
            'quantity' => 'required|integer|min:1',
            'expiration_date' => 'required|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi gambar
        ]);

        $medicineData = [
            'name' => $request->name,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'expiration_date' => $request->expiration_date,
        ];

        // Jika ada gambar baru, hapus gambar lama dan simpan gambar baru
        if ($request->hasFile('image')) {
            $medicine->deleteImage();  // Menghapus gambar lama dari storage
            $medicineData['image'] = Medicine::storeImage($request->file('image'));
        }

        $medicine->update($medicineData);

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine updated successfully.');
    }

    /**
     * Remove the specified medicine from storage.
     */
    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);

        // Menghapus gambar terkait
        $medicine->deleteImage();

        // Menghapus data obat dari database
        $medicine->delete();

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine deleted successfully.');
    }
}
