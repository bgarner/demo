<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */

    'name' => 'Ops Portal',

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'America/Edmonton',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'daily'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Laravel\Tinker\TinkerServiceProvider::class,


        App\Providers\RouteServiceProvider::class,
        Laravel\Dusk\DuskServiceProvider::class,
        // Laracademy\Commands\MakeServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

        App\Providers\AdminSidenavServiceProvider::class,
        App\Providers\AdminTopbarServiceProvider::class,
        App\Providers\StoreSidenavServiceProvider::class,
        App\Providers\StoreTopbarServiceProvider::class,
        App\Providers\StoreSkinProvider::class,
        App\Providers\StoreFooterProvider::class,
        Collective\Html\HtmlServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
        App\Providers\FormUserSidenavServiceProvider::class,
        Adldap\Laravel\AdldapServiceProvider::class,
        Adldap\Laravel\AdldapAuthServiceProvider::class,
        App\Providers\ManagerSidenavServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Debugbar' => Barryvdh\Debugbar\Facade::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Input' => Illuminate\Support\Facades\Input::class,
        'Adldap' => Adldap\Laravel\Facades\Adldap::class

    ],

    'controllerComponentMap' => [

        'App\Http\Controllers\AdminController'                                  => 'Home',
        'App\Http\Controllers\Analytics\AnalyticsAdminController'               => 'Home',
        'App\Http\Controllers\AdminSelectedBannerController'                    => 'Home',
        'App\Http\Controllers\Dashboard\DashboardAdminController'               => 'Dashboard',
        'App\Http\Controllers\Dashboard\DashboardBackgroundAdminController'     => 'Dashboard',
        'App\Http\Controllers\Dashboard\QuicklinksAdminController'              => 'Dashboard',
        'App\Http\Controllers\Feature\FeatureOrderAdminController'              => 'Dashboard',
        'App\Http\Controllers\Document\PackageAdminController'                  => 'Featured Content',
        'App\Http\Controllers\Feature\FeatureAdminController'                   => 'Featured Content',
        'App\Http\Controllers\Feature\FeatureThumbnailAdminController'          => 'Featured Content',
        'App\Http\Controllers\Feature\FeatureBackgroundAdminController'         => 'Featured Content',
        'App\Http\Controllers\Calendar\CalendarAdminController'                 => 'Calendar',
        'App\Http\Controllers\Calendar\EventTypesAdminController'               => 'Calendar',
        'App\Http\Controllers\Calendar\ProductLaunchAdminController'            => 'Calendar',
        'App\Http\Controllers\Communication\CommunicationAdminController'       => 'Communications',
        'App\Http\Controllers\Communication\CommunicationTypesAdminController'  => 'Communications',
        'App\Http\Controllers\Communication\CommunicationPartialController'     => 'Communications',
        'App\Http\Controllers\Communication\CommunicationTagController'         => 'Communications',
        'App\Http\Controllers\Utilities\CkeditorImageController'                => 'Communications',
        'App\Http\Controllers\Document\LibraryAdminController'                  => 'Library',
        'App\Http\Controllers\Document\FolderAdminController'                   => 'Library',
        'App\Http\Controllers\Document\DocumentAdminController'                 => 'Library',
        'App\Http\Controllers\Document\DocumentFolderAdminController'           => 'Library',
        'App\Http\Controllers\Document\DocumentTagController'                   => 'Library',
        'App\Http\Controllers\Alert\AlertAdminController'                       => 'Alerts and Notices',
        'App\Http\Controllers\Alert\AlertTypesAdminController'                  => 'Alerts and Notices',
        'App\Http\Controllers\UrgentNotice\UrgentNoticeAdminController'         => 'Alerts and Notices',
        'App\Http\Controllers\Video\VideoAdminController'                       => 'Videos',
        'App\Http\Controllers\Tag\TagAdminController'                           => 'Videos',
        'App\Http\Controllers\Video\VideoTagController'                         => 'Videos',
        'App\Http\Controllers\Video\PlaylistTagController'                      => 'Videos',
        'App\Http\Controllers\Video\PlaylistAdminController'                    => 'Videos',
        'App\Http\Controllers\Video\PlaylistVideoOrderController'               => 'Videos',
        'App\Http\Controllers\User\UserAdminController'                         => 'User and Group Management',
        'App\Http\Controllers\Auth\Group\GroupAdminController'                  => 'User and Group Management',
        'App\Http\Controllers\Auth\Group\GroupRoleAdminController'              => 'User and Group Management',
        'App\Http\Controllers\Auth\Role\RoleAdminController'                    => 'User and Group Management',
        'App\Http\Controllers\Auth\Role\RoleResourceAdminController'            => 'User and Group Management',
        'App\Http\Controllers\Auth\Resource\ResourceAdminController'            => 'User and Group Management',
        'App\Http\Controllers\Auth\Resource\ResourceTypeAdminController'        => 'User and Group Management',
        'App\Http\Controllers\Auth\Component\ComponentAdminController'          => 'User and Group Management',
        'App\Http\Controllers\StoreFeedback\FeedbackAdminController'            => 'Store Feedback Management',
        'App\Http\Controllers\StoreFeedback\NotesAdminController'               => 'Store Feedback Management',
        'App\Http\Controllers\Task\TaskAdminController'                         => 'Task Management',
        'App\Http\Controllers\Task\TasklistAdminController'                     => 'Task Management',
        'App\Http\Controllers\Task\TaskDocumentController'                      => 'Task Management',
        'App\Http\Controllers\Tools\CustomStoreGroupAdminController'            => 'Tools',
        'App\Http\Controllers\Tools\DirtyNodesAdminController'                  => 'Tools',
        'App\Http\Controllers\StoreComponent\StoreComponentAdminController'     => 'Components',
        'App\Http\Controllers\Flyer\FlyerAdminController'                       => 'Flyer',
        'App\Http\Controllers\Flyer\FlyerItemAdminController'                   => 'Flyer',
        'App\Http\Controllers\Utilities\BatchFileUploadController'              => 'Batch File Upload',
        'App\Http\Controllers\Form\ProductRequestFormAdminController'           => 'Form',
        'App\Http\Controllers\Form\FormListAdminController'                     => 'Form',
        'App\Http\Controllers\Form\FormLogController'                           => 'Form'

    ],


    'controllerFormMap' => [
        
        'App\Http\Controllers\Form\ProductRequestFormAdminController'            => 'product_request_form_v_1.0'

    ],


];
