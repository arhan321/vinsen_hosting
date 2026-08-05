<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table): void {
            if (! Schema::hasColumn('consultations', 'patient_last_read_message_id')) {
                $table->unsignedBigInteger('patient_last_read_message_id')
                    ->nullable()
                    ->after('last_message_sender')
                    ->index();
            }

            if (! Schema::hasColumn('consultations', 'patient_read_at')) {
                $table->timestamp('patient_read_at')
                    ->nullable()
                    ->after('patient_last_read_message_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table): void {
            $columns = [];

            if (Schema::hasColumn('consultations', 'patient_read_at')) {
                $columns[] = 'patient_read_at';
            }

            if (Schema::hasColumn('consultations', 'patient_last_read_message_id')) {
                $columns[] = 'patient_last_read_message_id';
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
