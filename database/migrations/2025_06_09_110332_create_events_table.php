<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("events", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Organizer reference
            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->onDelete("cascade");

            // Core event details
            $table->string("title", 150);
            $table->text("description")->nullable();
            $table->string("category")->nullable(); // e.g. Music, Tech, Sports

            // Schedule
            $table->dateTime("start_time");
            $table->dateTime("end_time")->nullable();

            // Location details
            $table->string("location");
            $table->string("landmark")->nullable();
            $table->decimal("latitude", 10, 7)->nullable();
            $table->decimal("longitude", 10, 7)->nullable();

            // Ticketing
            $table->unsignedInteger("capacity")->nullable(); // max number of attendees
            // $table->unsignedInteger("available_tickets")->nullable(); // for quick access/caching
            $table->double("price", 8, 2)->default(0.0); // Allow free events

            // Status flags
            $table->boolean("archived")->default(false);

            // SEO/friendly URLs
            // $table->string("slug")->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("events");
    }
};
