<?php

namespace App\Console\Commands\CMS;

use App\Models\Users\Users;
use App\Models\Users\UsersRoles;
use App\Models\Users\UsersRolesPermissions;
use App\Models\Menu;
use Illuminate\Console\Command;

class UsersTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:users:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing Command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $menu = Menu::find(1);
        $role = UsersRoles::find(1);
        $permission = UsersRolesPermissions::find(1);
        $User = Users::find(1);

        $this->line("Testing user relations");
        $userRoles = $User->roles();
        if($userRoles->count() == 0){
            sleep(1);
            $this->line("Adding role: ".$role->name);
            $User->addRole($role->id);
        }else{
            sleep(1);
            $this->line("Removing role: ".$role->name);
            $User->removeRole($role->id);

        }
        $this->line("Removing permission ".$permission->key." from role: ".$role->name);
        $role->removePermission($permission->id);
        sleep(1);
        $this->line("Adding permission ".$permission->key." to role: ".$role->name);
        $role->addPermission($permission->id);
        sleep(1);
        $this->line("Adding role ".$role->name." to menu: ".$menu->title);
        $menu->roles()->attach($role->id);
        sleep(1);
        $this->line("Removing role ".$role->name." from menu: ".$menu->title);
        $menu->roles()->detach($role->id);

    }
}
