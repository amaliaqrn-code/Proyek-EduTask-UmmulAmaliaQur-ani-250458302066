<?php

namespace App\Filament\Dosen\Resources\Courses\Schemas;

use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->default(null),
                TextInput::make('name')
                    ->label('Mata Kuliah')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Hidden::make('dosen_id')
                    ->default(function () {
                        return Auth::user()->dosen->id; // ambil ID dosen dari tabel dosens
                    }),
        ]);
    }
}
