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
        $tables = [
            'about_site',
            'account',
            'account_auth',
            'advertisment',
            'banner',
            'blog',
            'detail_order',
            'general_question',
            'guide',
            'level',
            'order_data',
            'our_team',
            'partner',
            'partner_auth',
            'portofolio',
            'privacy_policy',
            'rating',
            'service',
            'share_profit_company',
            'share_profit_drop_off',
            'share_profit_event',
            'share_profit_pickup',
            'site_contact',
            'site_information',
            'site_logo',
            'site_social_media',
            'sub_trash_category',
            'terms_of_service',
            'trash_category',
            'user',
            'user_auth',
            'version',
            'version_partner',
            'widraw_partner',
            'widraw_user',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                if (!Schema::hasColumn($table, 'id')) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->dropPrimary('id');
                        $table->bigIncrements('id')->autoIncrement();
                    });
                }

                if (!Schema::hasColumn($table, 'created_at')) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->timestamps();
                    });
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'about_site',
            'account',
            'account_auth',
            'advertisment',
            'banner',
            'blog',
            'detail_order',
            'general_question',
            'guide',
            'level',
            'order_data',
            'our_team',
            'partner',
            'partner_auth',
            'portofolio',
            'privacy_policy',
            'rating',
            'service',
            'share_profit_company',
            'share_profit_drop_off',
            'share_profit_event',
            'share_profit_pickup',
            'site_contact',
            'site_information',
            'site_logo',
            'site_social_media',
            'sub_trash_category',
            'terms_of_service',
            'trash_category',
            'user',
            'user_auth',
            'version',
            'version_partner',
            'widraw_partner',
            'widraw_user',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('id');
                $table->dropTimestamps();
            });
        }
    }

};
