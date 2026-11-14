<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SalesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_sales_index_displays_transactions(): void
    {
        $cashier = User::factory()->create(['name' => 'Kasir Test']);

        DB::table('sales')->insert([
            'user_id' => $cashier->id,
            'sale_number' => 'TRX-TEST-001',
            'total' => 125000,
            'status' => 'completed',
            'sold_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($cashier)
            ->get(route('sales.index'))
            ->assertOk()
            ->assertSee('TRX-TEST-001')
            ->assertSee('Kasir Test')
            ->assertSee('Rp 125.000')
            ->assertSee('Completed');
    }
}
