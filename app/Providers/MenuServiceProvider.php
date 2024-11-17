<?php

namespace App\Providers;

use App\Models\GlobalSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Schema;


use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    // Check if the global_settings table exists before querying it
    if (Schema::hasTable('global_settings')) {
      // Cache global setting for 60 minutes or retrieve it from the cache
      $globalSetting = cache()->remember('globalSetting', 60, function () {
        return GlobalSetting::where('id', 1)->first();
      });
    } else {
      // If the table doesn't exist, set globalSetting to null or a default value
      $globalSetting = null;
    }
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    $verticalMenuData = json_decode($verticalMenuJson);
    $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
    $horizontalMenuData = json_decode($horizontalMenuJson);

    // Share all menuData to all the views
    $this->app->make('view')->share('menuData', [$verticalMenuData, $horizontalMenuData, $globalSetting]);
  }
}
