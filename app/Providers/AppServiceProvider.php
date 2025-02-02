<?php

namespace App\Providers;

use App\Models\SMTP;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $row = SMTP::find(1);
        if ($row) {
            Config::set('mail.default', $row->mail_mailer);
            Config::set('mail.mailers.smtp.host', $row->mail_host);
            Config::set('mail.mailers.smtp.port', $row->mail_port);
            Config::set('mail.mailers.smtp.username', $row->mail_username);
            Config::set('mail.mailers.smtp.password', $row->mail_password);
            Config::set('mail.mailers.smtp.encryption', $row->mail_encryption);
            Config::set('mail.from.address', $row->mail_from_address);
            Config::set('app.name', $row->app_name);
        }

    }
}
