<?php

namespace App\Filament\Resources\Feedback\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('submission_id')
                    ->required()
                    ->numeric(),
                TextInput::make('dosen_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('mahasiswa_id')
                    ->numeric()
                    ->default(null),
                Textarea::make('comment')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('score')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
