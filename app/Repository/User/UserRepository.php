<?php

namespace App\Repository\User;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Avatar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserRepository implements UserRepositoryInterface
{
    public function store(UserStoreRequest $userStoreRequest): User
    {
        $validated = $userStoreRequest->validated();

        DB::beginTransaction();
        try {
            $newUser = new User();
            $newUser->name = $validated['name'];
            $newUser->email = $validated['email'];
            $newUser->password = $validated['password'];
            $newUser->slug = Str::slug($validated['name']);
            $newUser->save();

            if ($userStoreRequest->hasFile('avatar')) {
                $folderLevel = $newUser->created_at->format('Y/m');
                $pathName = $userStoreRequest->file('avatar')->store($folderLevel, 'public');
                Avatar::query()->create([
                    'path' => last(explode('/', $pathName)),
                    'user_id' => $newUser->id
                ]);
            }

            DB::commit();
            return $newUser;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            throw new BadRequestHttpException($exception->getMessage());
        }
    }

    public function update(
        UserUpdateRequest $userUpdateRequest,
        User              $user): User
    {
        $user->name = $userUpdateRequest->name;
        $user->email = $userUpdateRequest->email;
        if ($userUpdateRequest->password) {
            $user->password = bcrypt($userUpdateRequest->password);
        }
        $user->save();

        return $user;
    }

    public function destroy(User $user): bool
    {
        return $user->delete();
    }
}