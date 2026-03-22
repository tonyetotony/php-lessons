<?php

namespace App\Http\Controllers;

use App\Http\Requests\Channel\StoreChannelRequest;
use App\Http\Requests\Channel\UpdateChannelRequest;
use App\Models\Channel;
use App\Services\FolderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChannelController extends Controller
{
    private const PER_PAGE = 10;

    public function __construct(
        private readonly FolderService $folderService,
    )
    {
    }

    public function subscribe(Channel $channel): RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $channel->subscribers()->attach($user->id);

        return redirect()->back()->with('success', 'Вы подписались на канал!');
    }

    public function unsubscribe(Channel $channel): RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $channel->subscribers()->detach($user->id);

        return redirect()->back()->with('success', 'Вы отписались от канала!');
    }

    public function create(): View
    {
        return view('channels.create');
    }

    public function store(StoreChannelRequest $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validated();
        $data['user_id'] = $user->id;
        $data['cover_path'] = $request->hasFile('cover') ? $this->folderService->fileMv($data['cover'], 'channel/cover') : null;

        $channel = Channel::create($data);

        return redirect()->route('channels.show', $channel)->with('success', 'Канал успешно создан!');
    }

    public function show(Channel $channel): View
    {
        $videos = $channel->videos()->paginate(self::PER_PAGE)->withQueryString();
        $isSubscribed = Auth::check() && $channel->subscribers()->where('user_id', Auth::id())->exists();
        $subscriberCount = $channel->subscribers()->count();

        return view('channels.show', [
            'channel' => $channel->load('videos', 'owner'),
            'videos' => $videos,
            'isSubscribed' => $isSubscribed,
            'subscriberCount' => $subscriberCount
        ]);
    }

    public function edit(Channel $channel): View
    {
        $user = Auth::user();
        if ($channel->user_id !== $user->id) {
            abort(403, 'У вас нет прав для редактирования этого канала.');
        }
        
        return view('channels.edit', compact('channel'));
    }

    public function update(UpdateChannelRequest $request, Channel $channel): RedirectResponse
    {
        $user = Auth::user();
        if ($channel->user_id !== $user->id) {
            abort(403, 'У вас нет прав для редактирования этого канала.');
        }
        
        $data = $request->validated();
        
        if ($request->hasFile('cover')) {
            $data['cover_path'] = $this->folderService->fileMv($data['cover'], 'channel/cover');
        }
        
        $channel->update($data);
        
        return redirect()->route('channels.show', $channel)->with('success', 'Канал успешно обновлен!');
    }
}