<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Services\FolderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VideoController extends Controller
{
    private const PER_PAGE = 10;

    public function __construct(
        private readonly FolderService $folderService,
    )
    {
    }

    public function index(): View
    {
        $videos = Video::query()->paginate(self::PER_PAGE);

        return view('videos.index', [
            'videos' => $videos
        ]);
    }

    public function show(Video $video): View
    {
        return view('videos.show', [
            'video' => $video
        ]);
    }

    public function create(): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user->myChannel) {
            return redirect()->route('videos.index');
        }
        return view('videos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'path' => 'required|unique:videos,path',
        ]);

        $data = $request->input();
        $data['cover_path'] = $this->folderService->fileMv($data['cover'], 'cover');
        $data['path'] = $this->extractRutubeEmbedUrl($data['path']);

        $data['channel_id'] = Auth::user()->myChannel->id;
        $video = Video::query()->create($data);

        return redirect()->route('videos.show', $video->id);
    }

    private function extractRutubeEmbedUrl(string $input): string
    {
        // Убираем лишние пробелы по краям
        $input = trim($input);

        // Проверяем, есть ли вообще iframe
        if (stripos($input, '<iframe') === false) {
            return $input;
        }

        // Ищем src внутри iframe
        if (preg_match('/<iframe[^>]*src=["\'](.*?)["\']/i', $input, $matches)) {
            $url = $matches[1];

            // Убеждаемся, что это действительно rutube
            if (strpos($url, 'rutube.ru/play/embed/') !== false) {
                // Можно дополнительно почистить параметры после ?
                $url = preg_replace('/\?.*$/', '', $url);
                return $url;
            }
        }

        // Если ничего не нашли — возвращаем оригинал
        return $input;
    }
}