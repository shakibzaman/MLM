<?php

namespace App\Providers;

// use App\Models\GlobalSetting;

use App\Models\CompanySetting;
use App\Models\GlobalSetting;
use App\Models\SeoTool;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use JoeDixon\Translation\Drivers\Translation;


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
  public function boot(Translation $translation): void
  {
    if (Schema::hasTable('global_settings')) {
      // Fetch the global setting, caching it for 60 minutes
      $globalSetting = cache()->remember('globalSetting', 60, function () {
        return GlobalSetting::where('id', 1)->first();
      });
      // Company Settings 
      $companySettings = CompanySetting::where('id', '1')->first();
      if ($companySettings) {
        Config::set('variables.templateDescription', $companySettings->meta_description);
        Config::set('variables.google_analytics_id', $companySettings->google_analytic_key);
        Config::set('variables.googleSiteVerification', $companySettings->google_webmaster_tool_code);
      }

      $seoTools = SeoTool::where('id', 1)->first();
      if ($seoTools) {
        Config::set('variables.templateKeyword', $seoTools->meta_tags);
      }

      // Share the setting with all views
      if ($globalSetting && $globalSetting->timezon) {
        // Set the application timezone based on the global setting
        config(['app.timezone' => $globalSetting->timezon]);
        date_default_timezone_set($globalSetting->timezon);
      }

      // Share the global setting with all views
      View::share('globalSetting', $globalSetting);
    } else {
      // If the table doesn't exist, set globalSetting to null and share with views
      $globalSetting = null;
      View::share('globalSetting', $globalSetting);
    }

    $languages = $translation->allLanguages();
    if ($languages) {
      View::share('languages', $languages);
    }


    Gate::define('admin-menu', function () {
      if (auth()->guard('web')->user()) {
        return auth()->guard('web')->user()->type == 1;
      }
    });

    Gate::define('customer-menu', function () {
      if (auth()->guard('customer')->user()) {
        return auth()->guard('customer')->user();
      }
    });

    Vite::useStyleTagAttributes(function (?string $src, string $url, ?array $chunk, ?array $manifest) {
      if ($src !== null) {
        return [
          'class' => preg_match("/(resources\/assets\/vendor\/scss\/(rtl\/)?core)-?.*/i", $src) ? 'template-customizer-core-css' : (preg_match("/(resources\/assets\/vendor\/scss\/(rtl\/)?theme)-?.*/i", $src) ? 'template-customizer-theme-css' : '')
        ];
      }
      return [];
    });
  }
}
