<?php

namespace App\Providers;

use danog\MadelineProto\API;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use danog\MadelineProto\Settings\AppInfo;

class MadelineProtoServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function register(): void
    {
        $this->app->singleton(API::class, function ($app): API {

            $apiId = env('TELEGRAM_API_ID');
            $apiHash = env('TELEGRAM_API_HASH');
            $name = 'session';

            $sessionPath = Config::get('madelineproto.session_path');
            $sessionPath = storage_path("{$sessionPath}{$name}.madeline");

            if (file_exists($sessionPath)) {
                $MadelineProto = new API($sessionPath);
            } else {
                $settings = (new AppInfo)
                    ->setApiId($apiId)
                    ->setApiHash($apiHash);

                $MadelineProto = new API($sessionPath, $settings);
            }

            return $MadelineProto;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
