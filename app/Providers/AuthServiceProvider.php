<?php

namespace App\Providers;

use App\Category;
use App\StudyMaterial;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\StudyMaterialPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        StudyMaterial::class => StudyMaterialPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
