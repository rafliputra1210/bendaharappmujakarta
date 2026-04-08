<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    public function index()
    {
        // Mengambil semua data santri, diurutkan dari yang terbaru
        $santris = Santri::latest()->get();
        return view('santri.index', compact('santris'));
    }

    public function create()
    {
        return view('santri.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_murid' => 'required|unique:santris,id_murid',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string',
        ]);

        Santri::create($request->all());

        return redirect()->route('santri.index')->with('success', 'Data Santri berhasil ditambahkan.');
    }

    public function edit(Santri $santri)
    {
        return view('santri.edit', compact('santri'));
    }

    public function update(Request $request, Santri $santri)
    {
        // Validasi input (abaikan unique untuk ID santri yang sedang diedit)
        $request->validate([
            'id_murid' => 'required|unique:santris,id_murid,' . $santri->id,
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string',
        ]);

        $santri->update($request->all());

        return redirect()->route('santri.index')->with('success', 'Data Santri berhasil diperbarui.');
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();

        return redirect()->route('santri.index')->with('success', 'Data Santri berhasil dihapus.');
    }
}