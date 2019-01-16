<?php

/*
 * This file is part of ibrand/advert.
 *
 * (c) iBrand <https://www.ibrand.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $prefix = config('ibrand.app.database.prefix', 'ibrand_');

        Schema::create($prefix.'advert', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');                                               //名称
            $table->string('code');                                              //编码
            $table->tinyInteger('status')->default(1);                          //状态：1 有效 ，0 失效
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create($prefix.'goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name');
            $table->integer('sell_price')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $prefix = config('ibrand.app.database.prefix', 'ibrand_');

        Schema::dropIfExists($prefix.'advert');
    }
}
