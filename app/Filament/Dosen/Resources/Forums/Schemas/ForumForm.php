<?php

namespace App\Filament\Dosen\Resources\Forums\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ForumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                    ->label('Mata Kuliah')
                    ->relationship('course', 'name')
                    ->required(),
                Select::make('user_id')
                    ->label('Nama')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('parent_id')
                    ->numeric()
                    ->default(null),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
