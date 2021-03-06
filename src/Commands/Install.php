<?php


namespace Tsung\NovaManufacture\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Install extends Command
{
    protected $signature = "novamanufacture:install {--force}";

    protected $description = "Install Nova Manufacture";

    public function handle()
    {
        $this->publishConfig();

        $this->migrateDatabase();

        $this->addDefaultPermissions();
    }

    private function publishConfig()
    {
        $this->info("Publish NovaManufacture Config");
        $this->call("vendor:publish", ['--tag' => 'novamanufacture-config']);
        $this->info('Done');
    }

    private function migrateDatabase()
    {
        $this->call('migrate');
    }

    private function addDefaultPermissions()
    {
        $this->call("config:clear");

        $guard = config('nova.guard') ?: config('auth.defaults.guard');

        $userModel = config('auth.providers.users.model');
        $permissionModel = config('novauser.models.permission');

        $user = $userModel::first();
        $userRole = $user->roles->first();

        $resources = config("novamanufacture.resources");

        foreach($resources as $resource) {
            $modelPermissions = $this->defaultPermissions($resource::uriKey());
            foreach($modelPermissions as $name => $group) {
                $this->addPermissions($user, $permissionModel, $name, $group, $guard);
            }
        }

        $this->info("Set default permissions to {$userRole->name}");
        $userRole->givePermissionTo($permissionModel::all());
        $this->info("Done");
    }

    private function addPermissions($user, $permissionModel, $name, $group, $guard)
    {
        if(!$permissionModel::where('name', $name)->first()) {
            $permissionModel::create([
                'name' => $name,
                'group' => $group,
                'guard_name' => $guard,
                'user_id' => $user->id,
            ]);
        }
    }

    private function defaultPermissions($model)
    {
        $additional = [

        ];

        $permissions = [
            'viewAny ' . Str::slug($model) => $model,
            'view ' . Str::slug($model) => $model,
            'create ' . Str::slug($model) => $model,
            'update ' . Str::slug($model) => $model,
            'delete ' . Str::slug($model) => $model,
            'restore ' . Str::slug($model) => $model,
            'forceDelete ' . Str::slug($model) => $model,
        ];

        $permissions = array_merge($permissions, isset($additional[Str::slug($model)]) ? $additional[Str::slug($model)] : []);
        return $permissions;
    }

}
