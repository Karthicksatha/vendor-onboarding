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
        Schema::create('vendor_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('business_name');
            $table->enum('business_type',[
                'Individual',
                'Proprietorship',
                'Partnership',
                'Pvt Ltd',
                'LLP'
            ]);

            $table->string('contact_person_name');
            $table->string('contact_email');
            $table->string('contact_mobile');

            $table->string('company_pan');
            $table->string('gst_number')->nullable();

            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');

            $table->string('account_holder_name');
            $table->text('account_number'); 
            $table->string('ifsc_code');

            $table->enum('status',[
                'draft',
                'submitted',
                'sent_back',
                'approved',
                'rejected'
            ])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_applications');
    }
};
