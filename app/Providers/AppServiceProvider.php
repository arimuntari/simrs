<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Schema::defaultStringLength(255);
       Blade::directive('dateindo', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y'); ?>";
        });
        Blade::directive('rupiah', function ($uang) {
            return "<?php echo 'Rp. ' . number_format($uang, 0, '.', '.'); ?>";
        });
    }
}
