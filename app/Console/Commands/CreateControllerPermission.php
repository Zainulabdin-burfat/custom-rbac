<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Support\Str;

class CreateControllerPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will create permissions of the controllers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function getControllerMethodNames($controller, $controllerName, $namespace = "App\Http\Controllers")
    {

        // $controller_class = new ReflectionClass($namespace . '\\' . $controller);
        // $controller_methods = $controller_class->getMethods(ReflectionMethod::IS_PUBLIC);

        $controller_methods = get_class_methods($namespace . '\\' . $controller);

        $methods = [];
        foreach ($controller_methods as $method) {

            if($method === "__construct")
                continue;

            $methods[] = (string) Str::of($controllerName)->append(" " . $method)->slug('.');
            // $methods[] = (string) Str::of($controllerName)->append(" " . $method->name)->slug('.');

            // if ($method->name === "destroy")
            if ($method === "destroy")
                break;
        }

        return $methods;
    }

    public function handle()
    {

        // Permission::truncate();
        // $this->newLine();
        // $this->info("Permission table truncated.");
        // $this->newLine();


        $this->newLine(2);

        $files = File::files("app/Http/Controllers");

        if (isset($files[0]) && $files[0]->getBasename() === "Controller.php") {
            unset($files[0]);
        }
        if(!count($files))
            return $this->error("No Countrollers Found..!");

        $newPermissions = 0;
        $oldPermissions = 0;

        foreach ($files as $controller) {
            $fileName       = $controller->getBasename();
            $filePathName   = $controller->getPathname();
            $controller     = Str::of($filePathName)->afterLast('/')->remove('.php');
            $controllerName = Str::of($filePathName)->afterLast('/')->remove('Controller.php');

            if ($fileName === "Controller.php")
                continue;

            $methods = (array)$this->getControllerMethodNames($controller, $controllerName);

            if(!count($methods))
                $this->warn("No Methods Found In $controllerName");

            foreach ($methods as $method) {
                $permission = Permission::firstOrCreate(["name" => $method]);

                if ($permission->wasRecentlyCreated) {
                    $this->info("$controller permission created ($method)");
                    $newPermissions++;
                } else {
                    $this->warn("$controller permission already exists ($method)");
                    $oldPermissions++;
                }
            }
            $this->newLine();
            
        }
        $this->info("$newPermissions new permissions were created and $oldPermissions permissions already exists.");

        $this->newLine(2);

        $permissions = Permission::get('id')->pluck('id')->toArray();

        $permissionIds = [];
        foreach ($permissions as $permissionId) {
            $permissionIds[] = ['role_id' => 1, 'permission_id' => $permissionId];
        }

        if ($permissionIds) {
            $rolePermission = RolePermission::insertOrIgnore($permissionIds);
            if ($rolePermission)
                $this->info("$rolePermission Permissions assigned to Admin");
            else
                $this->warn("Permissions already assigned to Admin");
        } else {
            $this->newLine();
            $this->warn("No Permissions Found..!");
            $this->newLine();
        }

        $this->newLine(2);




        $this->newLine(2);
        $this->alert("Note! The last method of the controller should be destroy method otherwise it will not create permissions after destroy method.");
        $this->newLine(2);

    }
}
