<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('make:service {name}')]
#[Description('Create a new service class')]
class MakeServiceCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name');

        $directory = app_path('Services');

        // creates the folder Services if does not exist
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $name . '.php';

        // Prevents overwriting an existing file
        if (file_exists($path)) {
            $this->error("Service {$name} already exists.");

            return self::FAILURE;
        }

        $content = <<<PHP
<?php

namespace App\Services;

class {$name}
{
    //
}

PHP;

        file_put_contents($path, $content);

        $this->info("Service {$name} created successfully.");

        return self::SUCCESS;
    }
}