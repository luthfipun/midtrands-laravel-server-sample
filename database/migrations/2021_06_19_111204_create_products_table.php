<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('cover');
            $table->integer('price');
            $table->timestamps();
        });

        $data = [
            [
                'title' => 'Chocolate Madness',
                'cover' => 'https://cdn.shopify.com/s/files/1/2951/2042/products/CHOCOLATE_MADNESS_CROP1_480x480.jpg',
                'price' => '450000',
            ],
            [
                'title' => 'Ovo Milo',
                'cover' => 'https://cdn.shopify.com/s/files/1/2951/2042/products/OVOMILO_CROP1_480x480.jpg',
                'price' => '200000',
            ],
            [
                'title' => 'Popcorn Caramello',
                'cover' => 'https://cdn.shopify.com/s/files/1/2951/2042/products/POPCORN_CROP1_480x480.jpg',
                'price' => '250000',
            ],
            [
                'title' => 'Lychee Rose',
                'cover' => 'https://cdn.shopify.com/s/files/1/2951/2042/products/LYCHEE_ROSE_CROP1_480x480.jpg',
                'price' => '100000',
            ],
        ];

        foreach ($data as $d){
            DB::table('products')->insert($d);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
