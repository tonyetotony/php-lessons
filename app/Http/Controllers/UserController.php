<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repository\User\UserRepository;
use App\Services\FilterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private const PER_PAGE = 10;

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly FilterService  $filterService
    )
    {
    }

    public function index(Request $request): View
    {
        $query = User::query()
            ->select([
                'id',
                'name',
                'email',
                'active',
                'slug',
                'created_at',
            ])
            ->with(
                'phones:id,user_id,number,phone_brand_id',
                'phones.phoneBrand:id,name'
            );

        return view('users.index', [
            'users' => $this->filterService->scopeApply($query, $request)
                ->paginate(100)
                ->withQueryString(),
        ]);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $userStoreRequest): RedirectResponse
    {
        $user = $this->userRepository->store($userStoreRequest);

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'User created successfully');
    }

    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function update(
        UserUpdateRequest $userUpdateRequest,
        User              $user
    ): RedirectResponse
    {
        $this->userRepository->update($userUpdateRequest, $user);

        return redirect()->route(
            'users.show',
            $user
        )->with('success', 'User updated successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        // Проверяем, есть ли у пользователя аватар
        if ($user->avatar) {
            $avatarPath = $user->avatarPath();
            
            // Удаляем файл аватара, если он существует
            if ($avatarPath && file_exists($avatarPath)) {
                unlink($avatarPath);
            }
        }
        
        // Удаляем пользователя через репозиторий
        $this->userRepository->destroy($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}