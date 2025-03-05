<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $badges = Badge::all();

        $seo = $this->generateSeo(
            $user->name,
            'Conheça mais sobre ' . $user->name . ', suas contribuições e atividades na plataforma Sabedoria Ancestral.',
            [$user->username],
            'website.profile.index',
            $user->username
        );

        return view('website.profile.index', [
            'user' => $user,
            'badges' => $badges,
            'seo' => $seo
        ]);
    }

}
