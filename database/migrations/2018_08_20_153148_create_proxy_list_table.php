<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProxyListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 255)->unique();
            $table->smallInteger('port', false, true);
            $table->string('country', 255);
            $table->tinyInteger('access')->unsigned()->default(1)->comment("0-не доступен, 1-доспупен");
            $table->string('anonymity');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proxy_list');
    }
}
