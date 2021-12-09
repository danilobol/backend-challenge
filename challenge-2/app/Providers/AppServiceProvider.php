<?php

namespace App\Providers;

use App\Repositories\Contracts\IGroupRepository;
use App\Repositories\Contracts\IUserGroupRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Contracts\IUserRoleRepository;
use App\Repositories\Group\GroupRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\UserGroup\UserGroupRepository;
use App\Repositories\UserRole\UserRoleRepository;
use App\Services\Contracts\IGroupService;
use App\Services\Contracts\ImLearnService;
use App\Services\Contracts\IUserGroupService;
use App\Services\Contracts\IUserRoleService;
use App\Services\Contracts\IUserService;
use App\Services\Group\GroupService;
use App\Services\mLearn\mLearnService;
use App\Services\User\UserService;
use App\Services\UserGroup\UserGroupService;
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
        $this->app->bind(ImLearnService::class, mLearnService::class);
        $this->app->bind(IUserGroupService::class, UserGroupService::class);
        $this->app->bind(IGroupService::class, GroupService::class);


        //repositories
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserRoleRepository::class, UserRoleRepository::class);
        $this->app->bind(IUserGroupRepository::class, UserGroupRepository::class);
        $this->app->bind(IGroupRepository::class, GroupRepository::class);

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
