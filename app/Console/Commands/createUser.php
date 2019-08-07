<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user in the users table';

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
     * Checks whether a username already exists.
     * @param $username The username to check
     * @return true if the user exists, false if it does not
     */
    private function hasUser($username)
    {
        return User::where('name', '=', $username)->exists();
    }

    /**
     * Validation checks for username
     * @param $username The username to check for
     * @return false if the check fails, true otherwise
     */
    private function checkUser($username)
    {
        if($this->hasUser($username))
        {
            $this->error('The specified username already exists! Please specify a different username!');
            return false;
        }

        return true;
    }

    /**
     * Validation checks for email
     * @param $email The e-mail address to check for
     * @return true if the provided parameter is a valid e-mail address
     */
    private function checkEmail($email)
    {
        return true;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = null;
        $email = null;
        do
        {
            $name = $this->ask('Please enter a username');
        }
        while(!$this->checkUser($name));

        do
        {
            $email = $this->ask('Please enter an e-mail address');
        }
        while(!$this->checkEmail($email));

        $homepage = $this->ask('Please enter a homepage (default: none)');
        $password = $this->secret('Please enter a password');
        $isAdmin = $this->confirm('Is this user an admin');

        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->homepage = $homepage;
        $newUser->password = Hash::make($password);
        $newUser->save();
    }
}
