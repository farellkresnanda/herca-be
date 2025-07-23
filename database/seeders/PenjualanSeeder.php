<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjualans')->insert([
            ['id' => 1, 'transaction_number' => 'TRX001', 'marketing_id' => 1, 'date' => '2023-05-22', 'cargo_fee' => 25000, 'total_balance' => 3000000, 'grand_total' => 3025000],
            ['id' => 2, 'transaction_number' => 'TRX002', 'marketing_id' => 3, 'date' => '2023-05-22', 'cargo_fee' => 25000, 'total_balance' => 320000, 'grand_total' => 345000],
            ['id' => 3, 'transaction_number' => 'TRX003', 'marketing_id' => 1, 'date' => '2023-05-22', 'cargo_fee' => 0, 'total_balance' => 65000000, 'grand_total' => 65000000],
            ['id' => 4, 'transaction_number' => 'TRX004', 'marketing_id' => 1, 'date' => '2023-05-23', 'cargo_fee' => 10000, 'total_balance' => 70000000, 'grand_total' => 70010000],
            ['id' => 5, 'transaction_number' => 'TRX005', 'marketing_id' => 2, 'date' => '2023-05-23', 'cargo_fee' => 10000, 'total_balance' => 80000000, 'grand_total' => 80010000],
            ['id' => 6, 'transaction_number' => 'TRX006', 'marketing_id' => 3, 'date' => '2023-05-23', 'cargo_fee' => 12000, 'total_balance' => 44000000, 'grand_total' => 44012000],
            ['id' => 7, 'transaction_number' => 'TRX007', 'marketing_id' => 1, 'date' => '2023-06-01', 'cargo_fee' => 0, 'total_balance' => 75000000, 'grand_total' => 75000000],
            ['id' => 8, 'transaction_number' => 'TRX008', 'marketing_id' => 2, 'date' => '2023-06-02', 'cargo_fee' => 0, 'total_balance' => 85000000, 'grand_total' => 85000000],
            ['id' => 9, 'transaction_number' => 'TRX009', 'marketing_id' => 2, 'date' => '2023-06-01', 'cargo_fee' => 0, 'total_balance' => 175000000, 'grand_total' => 175000000],
            ['id' => 10, 'transaction_number' => 'TRX010', 'marketing_id' => 3, 'date' => '2023-06-01', 'cargo_fee' => 0, 'total_balance' => 75000000, 'grand_total' => 75000000],
            ['id' => 11, 'transaction_number' => 'TRX011', 'marketing_id' => 2, 'date' => '2023-06-01', 'cargo_fee' => 0, 'total_balance' => 750020000, 'grand_total' => 750020000],
            ['id' => 12, 'transaction_number' => 'TRX012', 'marketing_id' => 3, 'date' => '2023-06-01', 'cargo_fee' => 0, 'total_balance' => 130000000, 'grand_total' => 120000000],
        ]);
    }
}
