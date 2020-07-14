<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertUserRoles extends Migration
{
    /**
     * Run the migrations. 
     *
     * @return void
     */
    public function up()
    {
        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            \App\Role::create(['name' => 'administrator', 'description' => 'Has access everywhere. Can register,delete or update user data']);
            \App\Role::create(['name' => 'postal_worker', 'description' => 'Can process orders.']);
            \App\Role::create(['name' => 'seller', 'description' => 'Can add orders in website.']);
            \App\Role::create(['name' => 'buyer', 'description' => 'Will buy products. Has access to his cart.']);
            \Illuminate\Support\Facades\DB::commit();
        } catch (Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
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
