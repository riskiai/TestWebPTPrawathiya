<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->date('tgl_faktur')->default(DB::raw('CURRENT_DATE'))->change();
        });
    }

    public function down()
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->date('tgl_faktur')->change();
        });
    }

};
