<?php

use App\Models\Role as ModelsRole;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->timestamps();
        });

        ModelsRole::insert([
            ['name' => 'Administrator', 'created_at' => Carbon::now()],
            ['name' => 'Subscriber', 'created_at' => Carbon::now()],
            ['name' => 'Guest', 'created_at' => Carbon::now()]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
