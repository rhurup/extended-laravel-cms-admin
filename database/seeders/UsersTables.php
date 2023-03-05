<?php

namespace Database\Seeders;

use App\Models\Users\Users;
use App\Models\Users\UsersRoles;
use App\Models\Users\UsersRolesPermissions;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PublicRole = UsersRoles::create(['name' => 'public', 'description' => 'Public user (Dont delete)']);
        $PublicPermissions = [];

        $UserRole = UsersRoles::create(['name' => 'user', 'description' => 'Normal user']);
        $UserPermissions = [];
        $UserPermissions[] = ['group' => 'user', 'key' => 'login', 'description' => 'Login in at the frontend'];
        $UserPermissions[] = ['group' => 'user', 'key' => 'register', 'description' => 'Register in at the frontend'];
        $UserPermissions[] = ['group' => 'user', 'key' => 'logout', 'description' => 'Logout in at the frontend'];
        $UserPermissions[] = ['group' => 'user', 'key' => 'verify-email', 'description' => 'Verify email in at the frontend'];
        $UserPermissions[] = ['group' => 'user', 'key' => 'send-reset-password-link', 'description' => 'Send reset password email in at the frontend'];
        $UserPermissions[] = ['group' => 'user', 'key' => 'confirm-reset-password-link', 'description' => 'Confirm reset password email in at the frontend'];
        $UserPermissions[] = ['group' => 'user', 'key' => 'show', 'description' => 'View own user'];
        $UserPermissions[] = ['group' => 'user', 'key' => 'update', 'description' => 'Edit own user'];

        foreach($UserPermissions as $UserPermission){
            $permission = UsersRolesPermissions::create($UserPermission);
            $UserRole->addPermission($permission->id);
        }

        echo "Creating public user\n";
        $User                    = new Users();
        $User->name              = 'Public user';
        $User->email             = 'public@user.com';
        $User->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $User->password          = bcrypt(Str::random(64));
        $User->api_token         = Str::random(64);
        $User->remember_token    = Str::random(64);
        $User->avatar            = 'images/avatar_default.png';
        $User->timezone_id       = (\App\Models\Countries\CountriesZones::where("zone_name", 'Europe/London')->first())->id;
        $User->language_id       = (\App\Models\Countries\CountriesLanguages::where("lang", 'en-GB')->first())->id;
        $User->save();

        $User->addRole($PublicRole->id);
        $User->removeRole($UserRole->id);
    }
}
