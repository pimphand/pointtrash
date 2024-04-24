<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-model-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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
            //command to create model
            $this->call('make:controller', ['name' => "Admin\\".Str::studly(Str::singular($table))."Controller", '-r' => true]);
        }
    }
}
