<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceToFloatInProductsTable extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('products', function (Blueprint $table) {
            $table->float('price', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        // You can't reverse the data type change in a down migration.
    }
}
