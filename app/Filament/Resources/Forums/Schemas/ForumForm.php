<?php

namespace App\Filament\Resources\Forums\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ForumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('parent_id')
                    ->numeric()
                    ->default(null),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
