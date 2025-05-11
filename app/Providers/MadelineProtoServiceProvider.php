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

            if (empty($apiId)) {
                throw new \RuntimeException('TELEGRAM_API_ID is not set in .env');
            }

            if (empty($apiHash)) {
                throw new \RuntimeException('TELEGRAM_API_HASH is not set in .env');
            }

            $name = 'session';
            $sessionPath = Config::get('madelineproto.session_path', 'app/madelineproto/');
            $sessionPath = storage_path("{$sessionPath}{$name}.madeline");

            $settings = (new AppInfo)
                ->setApiId($apiId)
                ->setApiHash($apiHash);

            return new API($sessionPath, $settings);
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
