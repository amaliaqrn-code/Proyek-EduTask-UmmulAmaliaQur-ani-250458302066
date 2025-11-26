<?php

namespace App\Filament\Dosen\Resources\Feedback\Schemas;

use App\Models\Dosen;
use App\Models\Submission;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class FeedbackForm
{
    public static function configure(Schema $schema): Schema
{
    return $schema
        ->components([
            // Submission ID otomatis dari URL
            Hidden::make('submission_id')
                ->default(fn () => request()->query('submission_id'))
                ->required(),

            TextInput::make('nama_mahasiswa')
                ->label('Nama Mahasiswa')
                ->dehydrated(false)
                ->default(fn ($record) => $record?->mahasiswa?->user?->name),

            // Comment
            Textarea::make('comment')
                ->label('Feedback')
                ->required()
                ->columnSpanFull(),

            // Score
            TextInput::make('score')
                ->numeric()
                ->required(),

            // Dosen otomatis
            Hidden::make('dosen_id')
                ->default(fn () => Dosen::where('user_id', Auth::id())->value('id')),
        ]);
   }
}
