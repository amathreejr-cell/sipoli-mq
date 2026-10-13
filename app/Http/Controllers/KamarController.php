<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\View\View;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kamars = Kamar::orderBy('nama')->paginate(10);

        return view('kamar.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:kamar,kode'],
            'nama' => ['required', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Kamar::create($validated);

        return redirect()
            ->route('kamar.index')
            ->with('success', 'Data kamar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar): View
    {
        $kamar->load([
            'santris' => function ($query) {
                $query->orderBy('nama');
            },
        ]);

        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar): View
    {
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:50',
                'unique:kamar,kode,' . $kamar->id,
            ],
            'nama' => ['required', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $kamar->update($validated);

        return redirect()
            ->route('kamar.show', $kamar)
            ->with('success', 'Data kamar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('kamar.index')
            ->with('success', 'Kamar berhasil dinonaktifkan.');
    }
}
