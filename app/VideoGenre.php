<?php

namespace App;

enum VideoGenre: string
{
    case ENTERTAINMENT    = 'entertainment';
    case GAMING           = 'gaming';
    case MUSIC            = 'music';
    case VLOG             = 'vlog';
    case EDUCATION        = 'education';
    case SCIENCE          = 'science';
    case TECHNOLOGY       = 'technology';
    case TRAVEL           = 'travel';
    case FOOD             = 'food';
    case LIFESTYLE        = 'lifestyle';
    case SPORTS           = 'sports';
    case FITNESS          = 'fitness';
    case BEAUTY           = 'beauty';
    case COMEDY           = 'comedy';
    case MOVIES           = 'movies';
    case ANIMATION        = 'animation';
    case NEWS             = 'news';
    case HOWTO            = 'howto';
    case PEOPLE_BLOGS     = 'people_blogs';
    case PETS_ANIMALS     = 'pets_animals';
    case AUTOS_VEHICLES   = 'autos_vehicles';
    case SHORTS           = 'shorts';
    case STREAM           = 'stream';
    case REACTION         = 'reaction';

    public function label(): string
    {
        return match($this) {
            self::ENTERTAINMENT    => 'Развлечения',
            self::GAMING           => 'Игры',
            self::MUSIC            => 'Музыка',
            self::VLOG             => 'Влоги',
            self::EDUCATION        => 'Образование',
            self::SCIENCE          => 'Наука',
            self::TECHNOLOGY       => 'Технологии',
            self::TRAVEL           => 'Путешествия',
            self::FOOD             => 'Еда и кулинария',
            self::LIFESTYLE        => 'Стиль жизни',
            self::SPORTS           => 'Спорт',
            self::FITNESS          => 'Фитнес и здоровье',
            self::BEAUTY           => 'Красота и мода',
            self::COMEDY           => 'Юмор и приколы',
            self::MOVIES           => 'Фильмы',
            self::ANIMATION        => 'Анимация',
            self::NEWS             => 'Новости',
            self::HOWTO            => 'Инструкции и туториалы',
            self::PEOPLE_BLOGS     => 'Люди и блоги',
            self::PETS_ANIMALS     => 'Животные и питомцы',
            self::AUTOS_VEHICLES   => 'Авто и транспорт',
            self::SHORTS           => 'Шортсы / короткие видео',
            self::STREAM           => 'Стримы',
            self::REACTION         => 'Реакции',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn($case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }
}