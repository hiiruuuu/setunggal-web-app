<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MenuManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tamu_tidak_dapat_mengakses_halaman_admin_menu()
    {
        $response = $this->get('/admin/menus');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function admin_dapat_melihat_daftar_menu()
    {
        $user = User::factory()->create();
        
        Menu::create([
            'name' => 'Kopi Susu Setunggal',
            'category' => 'Kopi',
            'price' => 18000,
            'is_available' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin/menus');

        $response->assertStatus(200);
        $response->assertSee('Kopi Susu Setunggal');
    }

    /** @test */
    public function admin_dapat_menambahkan_menu_baru_dengan_foto()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('kopi.jpg');

        $response = $this->actingAs($user)->post('/admin/menus', [
            'name' => 'Kopi Tubruk',
            'category' => 'Kopi',
            'price' => 12000,
            'description' => 'Kopi hitam tradisional.',
            'image' => $file,
        ]);

        $response->assertRedirect(route('menus.index'));
        $this->assertDatabaseHas('menus', ['name' => 'Kopi Tubruk']);
        
        // Memastikan file gambar benar-benar tersimpan di storage fake
        $this->assertTrue(Storage::disk('public')->exists('menus/' . $file->hashName()));
    }

    /** @test */
    public function admin_dapat_mengubah_status_ketersediaan_menu()
    {
        $user = User::factory()->create();
        
        $menu = Menu::create([
            'name' => 'Es Teh Manis',
            'category' => 'Non-Kopi',
            'price' => 5000,
            'is_available' => true,
        ]);

        $response = $this->actingAs($user)->patch("/admin/menus/{$menu->id}/toggle");

        $response->assertRedirect();
        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'is_available' => false,
        ]);
    }

    /** @test */
    public function admin_dapat_menghapus_menu_beserta_file_gambarnya()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('roti.jpg');
        $imagePath = $file->store('menus', 'public');

        $menu = Menu::create([
            'name' => 'Roti Bakar Cokelat',
            'category' => 'Camilan',
            'price' => 15000,
            'image' => $imagePath,
            'is_available' => true,
        ]);

        $response = $this->actingAs($user)->delete("/admin/menus/{$menu->id}");

        $response->assertRedirect(route('menus.index'));
        $this->assertDatabaseMissing('menus', ['id' => $menu->id]);
        
        // Memastikan file gambar benar-benar terhapus dari storage
        $this->assertFalse(Storage::disk('public')->exists($imagePath));
    }
}