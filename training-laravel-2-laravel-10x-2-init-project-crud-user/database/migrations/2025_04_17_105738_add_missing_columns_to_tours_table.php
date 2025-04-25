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
        Schema::table('tours', function (Blueprint $table) {
            if (!Schema::hasColumn('tours', 'tour_name')) {
                $table->string('tour_name')->nullable()->after('tour_id');
            }
            if (!Schema::hasColumn('tours', 'tour_image')) {
                $table->string('tour_image')->nullable()->after('tour_name');
            }
            if (!Schema::hasColumn('tours', 'start_day')) {
                $table->date('start_day')->nullable()->after('tour_image');
            }
            if (!Schema::hasColumn('tours', 'time')) {
                $table->string('time')->nullable()->after('start_day');
            }
            if (!Schema::hasColumn('tours', 'star_from')) {
                $table->string('star_from')->nullable()->after('time');
            }
            if (!Schema::hasColumn('tours', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('star_from');
            }
            if (!Schema::hasColumn('tours', 'vehicle')) {
                $table->string('vehicle')->nullable()->after('price');
            }
            if (!Schema::hasColumn('tours', 'tour_description')) {
                $table->text('tour_description')->nullable()->after('vehicle');
            }
            if (!Schema::hasColumn('tours', 'tour_schedule')) {
                $table->text('tour_schedule')->nullable()->after('tour_description');
            }
            if (!Schema::hasColumn('tours', 'tour_sale')) {
                $table->string('tour_sale')->nullable()->after('tour_schedule');
            }
            if (!Schema::hasColumn('tours', 'total_seats')) {
                $table->integer('total_seats')->nullable()->after('tour_sale');
            }
            if (!Schema::hasColumn('tours', 'booked_seats')) {
                $table->integer('booked_seats')->nullable()->after('total_seats');
            }
            if (!Schema::hasColumn('tours', 'location_id')) {
                $table->unsignedInteger('location_id')->nullable()->after('booked_seats');
                $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            }
            if (!Schema::hasColumn('tours', 'guide_id')) {
                $table->unsignedInteger('guide_id')->nullable()->after('location_id');
                $table->foreign('guide_id')->references('guide_Id')->on('guides')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['guide_id']);
            $table->dropColumn([
                'tour_name',
                'tour_image',
                'start_day',
                'time',
                'star_from',
                'price',
                'vehicle',
                'tour_description',
                'tour_schedule',
                'tour_sale',
                'total_seats',
                'booked_seats',
                'location_id',
                'guide_id',
            ]);
        });
    }
};