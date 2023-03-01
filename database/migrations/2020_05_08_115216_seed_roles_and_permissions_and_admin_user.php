<?php

use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SeedRolesAndPermissionsAndAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $UserRole = \App\Models\Users\UserAclRole::create(['name' => 'user', 'display_name' => 'Normal user']);

        $AdminPermissions = [];
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
            $permission = \App\Models\Users\UserAclPermission::create($UserPermission);
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
        \App\Models\Users\UserRoles::create(['role_id'=> $UserRole->id, 'user_id' => $User->id]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
