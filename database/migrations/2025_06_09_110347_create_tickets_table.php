<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("tickets", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("phone", 10);
            $table->string("email");
            $table->double("amount_paid", 10, 7);
            $table
                ->foreignIdFor(Event::class)
                ->constrained()
                ->onDelete("cascade");
            $table->string("qr_code")->unique();
            $table->timestamp("scanned_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tickets");
    }
};
