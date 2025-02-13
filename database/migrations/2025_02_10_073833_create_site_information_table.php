<?php

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
        Schema::create('site_information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('home');
            $table->json('about_us');
            $table->json('we_are');
            $table->json('projects');
            $table->json('services');
            $table->json('contact_us');
            $table->json('footer');
            $table->json('terms_and_conditions');
            $table->json('privacy_policy');
            $table->json('cookies_policy');
            $table->json('sitemap');
            $table->json('robots_txt');
            $table->json('rss_feed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_information');
    }
};
