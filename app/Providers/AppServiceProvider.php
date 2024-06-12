<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Traits\HasPermissionsTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use HasPermissionsTrait;
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
    public function boot(): void    
    {       
        try {            
            Permission::get()->map(function ($permission) {               
                Gate::define($permission->name, function ($user) use ($permission) {                   
                    return $user->hasPermissionTo($permission);                    
                });            
            }); 
        } catch (\Exception $e) {            
            report($e);        
        }        
        
        Blade::directive('role', function ($role) {           
            return "<?php if(auth()->check() && auth()->user()->hasRole($role)) : ?>";            
        });        
        
        Blade::directive('endrole', function () {           
            return "<?php endif; ?>";            
        });    
// dd($permission,auth()->user()->hasPermission($permission));
        // Custom @can directive for permissions
        Blade::directive('can', function ($permission) {
            return "<?php if(auth()->check() && auth()->user()->hasPermission($permission)) : ?>";
        });

        Blade::directive('endcan', function () {
            return "<?php endif; ?>";
        });

      
    }    
}
