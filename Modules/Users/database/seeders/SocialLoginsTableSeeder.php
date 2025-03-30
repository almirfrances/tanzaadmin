<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Users\Models\SocialLogin;

class SocialLoginsTableSeeder extends Seeder
{


    public function run()
    {
        $baseUrl = url('/'); // Get the application's base URL

        $socialLogins = [
            [
                'provider' => 'google',
                'client_id' => 'your-google-client-id',
                'client_secret' => 'your-google-client-secret',
                'redirect_url' => $baseUrl . '/social-login/google/callback',
                'status' => true,
            ],
            [
                'provider' => 'facebook',
                'client_id' => 'your-facebook-client-id',
                'client_secret' => 'your-facebook-client-secret',
                'redirect_url' => $baseUrl . '/social-login/facebook/callback',
                'status' => false,
            ],
            [
                'provider' => 'github',
                'client_id' => 'your-github-client-id',
                'client_secret' => 'your-github-client-secret',
                'redirect_url' => $baseUrl . '/social-login/github/callback',
                'status' => true,
            ],
            [
                'provider' => 'twitter',
                'client_id' => 'your-twitter-client-id',
                'client_secret' => 'your-twitter-client-secret',
                'redirect_url' => $baseUrl . '/social-login/twitter/callback',
                'status' => false,
            ],
        ];

        foreach ($socialLogins as $socialLogin) {
            SocialLogin::updateOrCreate(
                ['provider' => $socialLogin['provider']],
                $socialLogin
            );
        }
    }

}
