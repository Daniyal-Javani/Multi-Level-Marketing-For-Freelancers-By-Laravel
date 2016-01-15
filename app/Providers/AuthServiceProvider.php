<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Validator;
use App\User;
use Session;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        Validator::extend('username_check', function($attribute, $value, $parameters, $validator) {
            $user = User::where('name', $value);
            if ($user->exists() == null) {
                return false;
            } else {
                $user = $user->first();
                Session::flash('root_user_id', $user->id);
                Session::flash('root_id', $user->root_id);
                return true;
            };
        });

        $this->registerPolicies($gate);

        //
    }
}
