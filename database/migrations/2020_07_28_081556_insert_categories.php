<?php

use App\Categories;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon::now()->toDateTimeString();
        try {
            DB::beginTransaction();
            Categories::create(['name' => 'Laptops', 'created_at'=> $now, 'updated_at'=> $now]);
            Categories::create(['name' => 'Desktops', 'created_at'=> $now, 'updated_at'=> $now]);
            Categories::create(['name' => 'Mobile Phones', 'created_at'=> $now, 'updated_at'=> $now]);
            Categories::create(['name' => 'Tablets', 'created_at'=> $now, 'updated_at'=> $now]);
            Categories::create(['name' => 'TVs', 'created_at'=> $now, 'updated_at'=> $now]);
            Categories::create(['name' => 'Digital Cameras', 'created_at'=> $now, 'updated_at'=> $now]);
            Categories::create(['name' => 'Accessories', 'created_at'=> $now, 'updated_at'=> $now]);
            Categories::create(['name' => 'Other', 'created_at'=> $now, 'updated_at'=> $now]);


            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
