<?php

namespace App\Console\Commands\Role;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate and sync legacy role system into new one';

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
     * @return mixed
     */
    public function handle()
    {
        if (!Schema::hasTable($table = 'permission_role')) {
            $this->error(sprintf('Table %s does not exists. Please run "php artisan migrate" first.', $table));

            return 1;
        }

        $this->call('db:seed', ['--class' => 'RoleUserTableSeeder']);
        $this->call('db:seed', ['--class' => 'PermissionsTableSeeder']);

        $this->info('Roles and permissions migrated successfully.');

        return 0;
    }
}
