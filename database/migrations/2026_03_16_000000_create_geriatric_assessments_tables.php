<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Main Assessment Table
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->integer('birth_year');
            $table->tinyInteger('gender')->comment('1: Nam, 2: Nữ');
            $table->string('phone_number')->nullable();
            $table->string('previous_job')->nullable();
            $table->float('height');
            $table->float('weight');
            $table->float('bmi');
            
            // Summary scores
            $table->integer('cci_total_score')->default(0);
            $table->integer('minicog_total_score')->default(0);
            $table->integer('mna_total_score')->default(0);
            $table->integer('cfs_total_score')->default(0);
            $table->integer('morse_total_score')->default(0);
            $table->integer('gds_total_score')->default(0);
            
            $table->timestamps();
        });

        // 2. CCI Details (Charlson Comorbidity Index)
        Schema::create('cci_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->boolean('nhoi_mau_co_tim')->default(false);
            $table->boolean('suy_tim')->default(false);
            $table->boolean('benh_mach_mau_ngoai_vi')->default(false);
            $table->boolean('benh_mach_nao')->default(false);
            $table->boolean('hen_phe_quan_copd')->default(false);
            $table->boolean('dai_thao_duong_chua_bien_chung')->default(false);
            $table->boolean('tram_cam')->default(false);
            $table->boolean('dung_thuoc_chong_dong_mau')->default(false);
            $table->boolean('alzheimer_suy_giam_tri_nho')->default(false);
            $table->boolean('benh_mo_lien_ket')->default(false);
            $table->boolean('tang_huyet_ap')->default(false);
            $table->boolean('liet_nua_nguoi')->default(false);
            $table->boolean('dai_thao_duong_co_bien_chung')->default(false);
            $table->boolean('benh_than_trung_binh_nang')->default(false);
            $table->boolean('ung_thu_tai_cho')->default(false);
            $table->boolean('benh_gan_man_tinh_vua_nang')->default(false);
            $table->boolean('ung_thu_di_can')->default(false);
            $table->boolean('hiv_aids')->default(false);
            $table->timestamps();
        });

        // 3. Mini-Cog Details
        Schema::create('minicog_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->integer('clock_drawing_score')->default(0); // 0 or 2
            $table->integer('recall_score')->default(0); // 0-3
            $table->timestamps();
        });

        // 4. MNA Details (Mini Nutritional Assessment)
        Schema::create('mna_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->integer('giam_an_uong')->default(0);
            $table->integer('sut_can')->default(0);
            $table->integer('kha_nang_van_dong')->default(0);
            $table->integer('stress_tam_ly')->default(0);
            $table->integer('van_de_tam_than_kinh')->default(0);
            $table->integer('bmi_score')->default(0);
            $table->timestamps();
        });

        // 5. CFS Details (Clinical Frailty Scale)
        Schema::create('cfs_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->integer('cfs_level')->default(1);
            $table->timestamps();
        });

        // 6. Morse Details (Fall Risk)
        Schema::create('morse_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->integer('tien_su_te_nga')->default(0);
            $table->integer('benh_ly_di_kem')->default(0);
            $table->integer('duong_truyen_dich')->default(0);
            $table->integer('ho_tro_di_lai')->default(0);
            $table->integer('bat_thuong_di_chuyen')->default(0);
            $table->integer('tinh_trang_tinh_than')->default(0);
            $table->timestamps();
        });

        // 7. GDS Details (Geriatric Depression Scale)
        Schema::create('gds_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            // 15 questions, boolean answers (true could mean depressed indicator depending on question)
            for ($i = 1; $i <= 15; $i++) {
                $table->boolean("q{$i}")->default(false);
            }
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gds_details');
        Schema::dropIfExists('morse_details');
        Schema::dropIfExists('cfs_details');
        Schema::dropIfExists('mna_details');
        Schema::dropIfExists('minicog_details');
        Schema::dropIfExists('cci_details');
        Schema::dropIfExists('assessments');
    }
};
