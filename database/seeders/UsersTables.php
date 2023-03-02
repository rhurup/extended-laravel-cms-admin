<?php

namespace Database\Seeders;

use App\Models\Users\User;
use App\Models\Users\UserAclRole;
use App\Models\Users\UserRoles;
use App\Models\Users\UserAclPermission;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $UserRole = UserAclRole::create(['name' => 'user', 'display_name' => 'Normal user']);

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
            $permission = UserAclPermission::create($UserPermission);
            $UserRole->addPermission($permission->id);
        }

        echo "Creating public user\n";
        $User                    = new User();
        $User->name              = 'Public user (Dont delete)';
        $User->email             = 'public@example.com';
        $User->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $User->password          = bcrypt(Str::random(16) . Carbon::now()->format('Y-m-d'));
        $User->api_token         = Str::random(64);
        $User->remember_token    = Str::random(64);
        $User->avatar            = 'images/avatar_default.png';
        $User->timezone_id          = (\App\Models\Countries\CountriesZones::where("zone_name", 'Europe/London')->first())->id;
        $User->language_id          = (\App\Models\Countries\CountriesLanguages::where("lang", 'en-GB')->first())->id;
        $User->save();

        UserRoles::create(['role_id'=> $UserRole->id, 'user_id' => $User->id]);
    }
}
