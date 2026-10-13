<?php

namespace App\Http\Controllers;

use App\Models\IdentitasPoliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class IdentitasPoliklinikController extends Controller
{
    /**
     * Menampilkan pengaturan identitas poliklinik.
     */
    public function edit(): View
    {
        $identitas = IdentitasPoliklinik::first();

        return view('pengaturan.identitas-poliklinik', compact('identitas'));
    }

    /**
     * Menyimpan perubahan identitas poliklinik.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:200',
            ],
            'alamat' => [
                'nullable',
                'string',
            ],
            'telepon' => [
                'nullable',
                'string',
                'max:30',
            ],
            'email' => [
                'nullable',
                'email',
                'max:100',
            ],
            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'nama_penandatangan' => [
                'nullable',
                'string',
                'max:150',
            ],
            'jabatan_penandatangan' => [
                'nullable',
                'string',
                'max:150',
            ],
        ]);

        $identitas = IdentitasPoliklinik::first();

        if (!$identitas) {
            $identitas = new IdentitasPoliklinik();
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            if (
                $identitas->logo &&
                Storage::disk('public')->exists($identitas->logo)
            ) {
                Storage::disk('public')->delete($identitas->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('identitas', 'public');
        }

        $identitas->fill($validated);
        $identitas->save();

        return redirect()
            ->route('pengaturan.identitas.edit')
            ->with('success', 'Identitas poliklinik berhasil diperbarui.');
    }
}