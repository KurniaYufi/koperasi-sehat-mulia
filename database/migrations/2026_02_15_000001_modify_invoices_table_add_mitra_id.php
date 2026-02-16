<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Add mitra_id foreign key after user_id
            $table->foreignId('mitra_id')->nullable()->after('user_id')->constrained('mitras')->cascadeOnDelete();
            // Drop the old string columns
            $table->dropColumn(['mitra', 'mitra_name']);
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Re-add the old columns
            $table->string('mitra')->after('invoice_date');
            $table->string('mitra_name')->after('mitra');
            // Drop the foreign key
            $table->dropForeignIdFor(\App\Models\Mitra::class);
            $table->dropColumn('mitra_id');
        });
    }
};
