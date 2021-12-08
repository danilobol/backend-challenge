<?php

namespace App\Providers;

use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Contracts\IUserRoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\UserRole\UserRoleRepository;
use App\Services\Contracts\IUserRoleService;
use App\Services\Contracts\IUserService;
use App\Services\User\UserService;
use App\Services\UserRole\UserRoleService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);

        //services
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRoleService::class, UserRoleService::class);


        //repositories
        $this->app->bind(IUserRoleRepository::class, UserRoleRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/', $value) && strlen($value) >= 10;
        });

        Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute',$attribute, ':attribute is invalid phone number');
        });
    }
}
