<?php

namespace App\Helpers;

use ReflectionClass;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

/**
 * Console commands manager
 *
 * Class TaskManager
 * @package App\Helpers
 */
class CommandManager
{
    private $commands;

    public function __construct()
    {
        $path = app_path('Console/Commands');
        $path = array_unique(Arr::wrap($path));
        $path = array_filter($path, function ($path) {
            return is_dir($path);
        });

        $appNamespace = app()->getNamespace();

        foreach ((new Finder)->in($path)->files()->sortByName() as $file) {
            $className = $appNamespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($file->getPathname(), app_path().DIRECTORY_SEPARATOR)
                );

            $reflectionClass = new ReflectionClass($className);

            if (is_subclass_of($className, Command::class) && !$reflectionClass->isAbstract()) {
                $properties = $reflectionClass->getDefaultProperties();
                $signature = $properties['signature'];
                $arguments = [];

                if (preg_match_all('#{(.+)}#', $signature, $matches)) {
                    $signature = Str::before($signature, ' {');
                    foreach($matches[1] as $match) {
                        list($argument, $default) = explode('=', $match);
                        $arguments[] = [
                            'id'        => $argument,
                            'title'     => __(Str::title($argument)),
                            'default'   => $default,
                        ];
                    }
                }

                $this->commands[] = [
                    'class'         => $className,
                    'signature'     => $signature,
                    'arguments'     => $arguments,
                    'description'   => $properties['description'],
                    'comments'      => $properties['comments'] ?? NULL,
                ];
            }
        }
    }

    public function all()
    {
        return $this->commands;
    }

    /**
     * Get specific command by its class
     *
     * @param $class
     * @return null
     */
    public function get($class)
    {
        $i = array_search($class, array_column($this->all(), 'class'), TRUE);
        return $i !== FALSE ? $this->commands[$i] : NULL;
    }
}