<?php

namespace App\Http\Requests\Channel;

use Illuminate\Foundation\Http\FormRequest;

class StoreChannelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100|unique:channels,title',
            'description' => 'required|string|max:500',
            'author_info' => 'required|string|max:500',
            'cover' => 'nullable|image|max:10240', // 10MB
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название канала обязательно.',
            'title.unique' => 'Канал с таким названием уже существует.',
            'description.required' => 'Описание контента обязательно.',
            'author_info.required' => 'Информация об авторе обязательна.',
            'cover.image' => 'Файл должен быть изображением.',
            'cover.max' => 'Размер аватара не должен превышать 10 МБ.',
        ];
    }
}