<?php

namespace Modules\Finance\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;

class CurrencyLivewireServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadComponents();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    protected function loadComponents()
    {
        $modules = \Module::toCollection();

        $filesystem = new Filesystem();

        $modules->map(function ($module) use ($filesystem) {
            $modulePath = $module->getPath();

            $moduleName = $module->getName();

            $sub_folders = [
                'Currencies'
            ];

            foreach ($sub_folders as $sub_folder) {
                $path = $modulePath.'/Http/Livewire/' . $sub_folder;

                $files = collect( $filesystem->isDirectory($path) ? $filesystem->allFiles($path) : [] );
    
                $files->map(function ($file) use ($moduleName, $path, $sub_folder) {
                    $componentPath = \Str::after($file->getPathname(), $path.'/');
    
                    $componentClassPath = strtr( $componentPath , ['/' => '\\', '.php' => '']);
            
                    $componentName = $this->getComponentName($componentClassPath, $moduleName, $sub_folder);
    
                    $componentClassStr = "\\Modules\\{$moduleName}\\Http\\Livewire\\" . $sub_folder . "\\".$componentClassPath;
    
                    $componentClass = get_class(new $componentClassStr);
    
                    $loadComponent = \Livewire::component($componentName, $componentClass);
                });
            }
        });
    }

    protected function getComponentName($componentClassPath, $moduleName = null, $sub_folder)
    {
        $dirs = explode('\\', $componentClassPath);
        
        $componentName = '';

        foreach ($dirs as $dir) {
            $componentName .= \Str::kebab( lcfirst($dir) ).'.';
        }

        $moduleNamePrefix = ($moduleName) ? \Str::lower($moduleName).'::' . \Str::lower($sub_folder) . '.' : null;

        $componentName = \Str::substr($moduleNamePrefix.$componentName, 0, -1);

       return $componentName;
    }
}
