<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();
        if (!$user->myChannel) {
            return redirect()->route('videos.public');
        }
        return view('dashboard.index');
    }

    public function myChannel(): View|RedirectResponse
    {
        $user = Auth::user();
        
        if (!$user->myChannel) {
            return view('dashboard.no-channel');
        }
        
        return redirect()->route('channels.show', $user->myChannel);
    }
}