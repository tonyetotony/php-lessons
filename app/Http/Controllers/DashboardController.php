<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    private const PER_PAGE = 10;

    public function index(): View|RedirectResponse
    {
        $user = Auth::user();
        if (!$user->myChannel) {
            return redirect()->route('videos.public');
        }

        // Получаем канал текущего пользователя
        $channel = $user->myChannel;

        // Статистика
        $videoCount = $channel->videos()->count();
        // Предполагается, что в таблице videos есть поле `views`
        $totalViews = $channel->videos()->sum('views') ?: 0;
        // Предполагается, что в таблице videos есть поле `watch_time_seconds`
        $totalWatchTimeHours = round(($channel->videos()->sum('watch_time_seconds') ?: 0) / 3600, 1);
        $subscriberCount = $channel->subscribers()->count();
        // Предполагается, что доход рассчитывается как $5 за 1000 просмотров
        $estimatedEarnings = round($totalViews / 1000 * 5, 2);

        $recentVideos = $channel->videos()->latest()->take(4)->get();

        return view('dashboard.index', [
            'totalViews' => $totalViews,
            'totalWatchTimeHours' => $totalWatchTimeHours,
            'subscriberCount' => $subscriberCount,
            'estimatedEarnings' => $estimatedEarnings,
            'recentVideos' => $recentVideos
        ]);
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