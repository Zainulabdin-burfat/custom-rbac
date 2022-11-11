<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Support\Str;
use Reflection;

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
    protected $description = 'This Command will create permissions of the newly created controller.';

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
            $methods[] = (string) Str::of($controllerName)->append(" " . $method->name)->slug('-');

            if ($method->name === "destroy") {
                break;
            }
        }

        return $methods;
    }

    public function handle()
    {
        Permission::truncate();
        $files = File::files("app/Http/Controllers");

        foreach ($files as $controller) {
            $fileName       = $controller->getBasename();
            $filePathName   = $controller->getPathname();
            $controller     = Str::of($filePathName)->afterLast('/')->remove('.php');
            $controllerName = Str::of($filePathName)->afterLast('/')->remove('Controller.php');

            if ($fileName === "Controller.php") {
                continue;
            }

            $methods = $this->getControllerMethodNames($controller, $controllerName);

            $permission = Permission::firstOrCreate([
                "name" => $controllerName,
                "slug" => json_encode($methods)
            ]);

            if ($permission->wasRecentlyCreated) {
                $this->info("$controller permission created.");
            } else {
                $this->info("$controller permission already exist.");
            }
        }

        // $this->newLine(2);
        // $this->error('Something went wrong!');
        // $this->newLine();
        // $this->line('Display this on the screen');
        // Artisan::command('mail:send {user}', function ($user) {
        //     $this->info("Sending email to: {$user}!");
        // });
    }
}
