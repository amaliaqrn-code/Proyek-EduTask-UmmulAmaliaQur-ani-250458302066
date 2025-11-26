<?php

namespace App\Filament\Mahasiswa\Resources\Materials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('file_url')
                    ->required(),
                TextInput::make('dosen_id')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
