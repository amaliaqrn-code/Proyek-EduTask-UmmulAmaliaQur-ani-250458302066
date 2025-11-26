<?php

namespace App\Filament\Resources\Mahasiswas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MahasiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Nama Lengkap')
                    ->options(function () {
                        return \App\Models\User::where('role', 'mahasiswa')->pluck('name', 'id');
                    })
                    ->required(),
                TextInput::make('nim')
                    ->default(null),
                TextInput::make('major')
                    ->default(null),
                TextInput::make('class')
                    ->default(null),
                TextInput::make('year')
                    ->numeric()
                    ->default(null),
                TextInput::make('total_points')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
