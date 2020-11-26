<?php

namespace Ngarawakimani\LaravelAPIBreeze\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api_breeze:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the API Breeze controllers and resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/API/Auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/App/Http/Controllers/API/Auth', app_path('Http/Controllers/API/Auth'));

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests/API/Auth'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/App/Http/Requests/API/Auth', app_path('Http/Requests/API/Auth'));

        // Tests...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/tests/Feature', base_path('tests/Feature'));

        // Routes...
        copy(__DIR__.'/../../stubs/routes/api.php', base_path('routes/api.php'));
        copy(__DIR__.'/../../stubs/routes/auth.php', base_path('routes/auth.php'));

        $this->info('API Breeze scaffolding installed successfully.');
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
