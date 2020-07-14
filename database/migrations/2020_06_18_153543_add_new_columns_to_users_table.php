<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class AddNewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->after('email')->constrained('roles', 'id');
            $table->string('last_name')->after('name');
            $table->string('company')->nullable()->after('last_name');
            $table->string('tel')->after('password');
            $table->string('tel2')->after('tel')->nullable();
            $table->string('state')->after('tel2');
            $table->string('city')->after('state');
            $table->boolean('isActive')->default(1)->after('city');
        });


        try {
            DB::beginTransaction();
            User::create([
                'role_id' => 1,
                'name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@test.test',
                'password' => Hash::make('12345678'),
                'tel' => '38344xxxxxx',
                'state' => 'Kosove',
                'city' => 'Prizren',
                'isActive' => 1
            ]);
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
