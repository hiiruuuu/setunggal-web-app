<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar menu di Dashboard Admin (dengan fitur pencarian opsional).
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        $menus = $query->latest()->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Menampilkan form untuk menambah menu baru.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Menyimpan data menu baru ke database (Create).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'price', 'description']);
        $data['is_available'] = $request->has('is_available') ? true : true; // Default true

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit menu.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Memperbarui data menu yang ada di database (Update).
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'price', 'description']);

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada di storage
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Menghapus menu dari database (Delete).
     */
    public function destroy(Menu $menu)
    {
        // Hapus foto terkait dari storage jika ada
        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }

    /**
     * Mengubah status ketersediaan menu (Ready / Habis) secara cepat.
     */
    public function toggleStatus(Menu $menu)
    {
        $menu->update([
            'is_available' => !$menu->is_available
        ]);

        return redirect()->back()->with('success', 'Status ketersediaan menu berhasil diperbarui.');
    }
}
