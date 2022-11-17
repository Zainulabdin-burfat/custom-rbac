<?php

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
        $controller_class = new ReflectionClass($namespace . '\\' . $controller);
        $controller_methods = $controller_class->getMethods(ReflectionMethod::IS_PUBLIC);

        $methods = [];
        foreach ($controller_methods as $method) {
            $methods[] = (string) Str::of($controllerName)->append(" " . $method->name)->slug('.');

            if ($method->name === "destroy")
                break;
        }

        return $methods;
    }

    public function handle()
    {

        Permission::truncate();
        $this->newLine();
        $this->info("Permission table truncated.");
        $this->newLine();


        $files = File::files("app/Http/Controllers");

        foreach ($files as $controller) {
            $fileName       = $controller->getBasename();
            $filePathName   = $controller->getPathname();
            $controller     = Str::of($filePathName)->afterLast('/')->remove('.php');
            $controllerName = Str::of($filePathName)->afterLast('/')->remove('Controller.php');

            if ($fileName === "Controller.php")
                continue;

            $methods = (array)$this->getControllerMethodNames($controller, $controllerName);

            foreach ($methods as $method) {
                $permission = Permission::firstOrCreate(["name" => $method]);

                if ($permission->wasRecentlyCreated) {
                    $this->info("$controller permission created ($method)");
                } else {
                    $this->info("$controller permission already exists ($method)");
                }
            }
        }

        $this->newLine(2);

        $permissions = Permission::get('id')->pluck('id')->toArray();

        $permissionIds = [];
        foreach ($permissions as $permissionId) {
            $permissionIds[] = ['role_id' => 1, 'permission_id' => $permissionId];
        }
        if ($permissionIds) {
            RolePermission::insert($permissionIds);
            $this->info("All permissions assigned to admin role");
        }

        $this->newLine(2);


        


        $this->newLine(2);
        $this->info("Warning!, The last method of the controller should be destroy method otherwise it will not create other permissions.");
        $this->newLine(2);

        // $this->newLine(2);
        // $this->error('Something went wrong!');
        // $this->newLine();
        // $this->line('Display this on the screen');
        // Artisan::command('mail:send {user}', function ($user) {
        //     $this->info("Sending email to: {$user}!");
        // });
    }
}
