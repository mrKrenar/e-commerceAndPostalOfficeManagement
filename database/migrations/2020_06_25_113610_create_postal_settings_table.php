<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\PostalSetting;
use Illuminate\Support\Facades\DB;

class CreatePostalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('transfer_fee');
            $table->timestamps();
        });

        try {
            DB::beginTransaction();
            PostalSetting::create(['transfer_fee' => 2]);
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
        Schema::dropIfExists('postal_settings');
    }
}
