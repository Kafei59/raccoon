<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Role;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {username} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin';

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
        $role = Role::where('name', '=', 'admin')->first();
        $user = new User();

        $user->name = $this->argument('username');
        $user->email = $this->argument('email');
        $user->password = bcrypt($this->secret('What is admin\'s password ?'));

        $user->save();
        $user->attachRole($role);
        $user->save();

        $this->line($user->name.": ".$user->password);
    }
}
