<?php

namespace App\Filament\Mahasiswa\Resources\Courses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('dosen_id')
                    ->label('Dosen')
                    ->relationship('dosen', 'nidn')
                    ->getOptionLabelFromRecordUsing(
                        fn (\App\Models\Dosen $record) => $record->user->name . ' - ' . $record->department
                    )
                    ->required(),
        ]);
    }
}
