<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('filament-webhook-server_table', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('url');
            $table->string('method');
            $table->string('model');
            $table->json('header');
            $table->string('data_option');
            $table->boolean('verifySsl');
            $table->timestamps();
        });
    }
};
