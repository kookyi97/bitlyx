<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            if (!Schema::hasColumn('usuarios', 'activo')) {
            $table->boolean('activo')->default(true)->after('xp_total');
        }
    });
}

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('activo');
        });
    }
};