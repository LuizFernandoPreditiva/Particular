<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id')->after('id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('planos_id')->nullable()->after('users_id'); 
            $table->foreign('planos_id')->references('id')->on('planos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign('clientes_users_id_foreign');
            $table->dropColumn('users_id');

            $table->dropForeign('clientes_planos_id_foreign');
            $table->dropColumn('planos_id');
        });
    }
}
