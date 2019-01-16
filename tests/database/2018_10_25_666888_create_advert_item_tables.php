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

class CreateAdvertItemTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $prefix = config('ibrand.app.database.prefix', 'ibrand_');

        Schema::create($prefix.'advert_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advert_id');                                             //推广位id
            $table->string('name')->nullable();                                      //标题
            $table->tinyInteger('status')->default(1);                              //状态：1 有效 ，0 失效
            $table->string('image')->nullable();                                   //图片url
            $table->string('link')->nullable();                                   //推广位链接
            $table->integer('sort')->default(99);                                //排序(越小越靠前）
            $table->string('type')->default('default');                         //类型
            $table->integer('associate_id')->nullable();                       //关联的类型ID：如商品ID 等
            $table->string('associate_type')->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->nestedSet();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $prefix = config('ibrand.app.database.prefix', 'ibrand_');

        Schema::dropIfExists($prefix.'advert_item');
    }
}
