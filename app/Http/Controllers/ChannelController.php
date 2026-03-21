<?php

namespace App\Http\Controllers;

use App\Http\Requests\Channel\StoreChannelRequest;
use App\Http\Requests\Channel\UpdateChannelRequest;
use App\Models\Channel;
use App\Services\FolderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ChannelController extends Controller
{
    private const PER_PAGE = 10;

    public function __construct(
        private readonly FolderService $folderService,
    )
    {
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
        $videos = $channel->videos()->paginate(self::PER_PAGE);

        return view('channels.show', [
            'channel' => $channel->load('videos'),
            'videos' => $videos
        ]);
    }

    public function edit(Channel $channel): View
    {
        return view('channels.edit', compact('channel'));
    }

    public function update(UpdateChannelRequest $request, Channel $channel): RedirectResponse
    {
        $data = $request->validated();
        
        if ($request->hasFile('cover')) {
            $data['cover_path'] = $this->folderService->fileMv($data['cover'], 'channel/cover');
        }
        
        $channel->update($data);
        
        return redirect()->route('channels.show', $channel)->with('success', 'Канал успешно обновлен!');
    }
}