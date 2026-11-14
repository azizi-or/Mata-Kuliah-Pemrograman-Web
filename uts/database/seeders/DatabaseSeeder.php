<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Utama',
                'password' => 'password123',
            ],
        );
        $admin->forceFill(['role' => 'admin'])->save();

        $staff = User::updateOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff Kasir',
                'password' => 'password123',
            ],
        );
        $staff->forceFill(['role' => 'staff'])->save();

        $electronics = Category::updateOrCreate(['name' => 'Elektronik']);
        $accessories = Category::updateOrCreate(['name' => 'Aksesoris']);

        Supplier::updateOrCreate(
            ['email' => 'supplier@jaya.com'],
            [
                'name' => 'PT Distributor Jaya',
                'phone' => '081234567890',
            ],
        );

        Product::updateOrCreate(
            ['sku' => 'PRD-001'],
            [
                'category_id' => $electronics->id,
                'name' => 'Mouse Wireless',
                'purchase_price' => 50000,
                'selling_price' => 85000,
                'stock' => 20,
                'minimum_stock' => 5,
            ],
        );

        Product::updateOrCreate(
            ['sku' => 'PRD-002'],
            [
                'category_id' => $accessories->id,
                'name' => 'Keyboard Mechanical',
                'purchase_price' => 250000,
                'selling_price' => 350000,
                'stock' => 10,
                'minimum_stock' => 3,
            ],
        );

        $owner = User::updateOrCreate(
            ['email' => 'owner@gmail.com'],
            [
                'name' => 'Owner Toko',
                'password' => 'password123',
            ],
        );
        $owner->forceFill(['role' => 'owner'])->save();
    }
}