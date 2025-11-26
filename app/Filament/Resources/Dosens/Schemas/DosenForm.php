<?php

namespace App\Filament\Resources\Dosens\Schemas;

use App\Models\Dosen;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DosenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Nama Lengkap')
                    ->options(function () {
                        return \App\Models\User::where('role', 'dosen')->pluck('name', 'id');
                    })
                    ->required(),
                TextInput::make('nidn')
                    ->required(),
                TextInput::make('department')
                    ->default(null),
            ]);
    }
}
