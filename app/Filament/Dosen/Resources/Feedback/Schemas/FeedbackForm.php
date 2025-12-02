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
                Hidden::make('submission_id')
                    ->default(fn() => request()->query('submission_id'))
                    ->required(),

                Hidden::make('mahasiswa_id')
                    ->default(
                        fn() =>
                        optional(
                            Submission::with('mahasiswa')->find(request()->query('submission_id'))
                        )->mahasiswa?->id
                    )
                    ->required(),

                TextInput::make('mahasiswa_nama')
                    ->label('Nama Mahasiswa')
                    ->default(
                        fn() =>
                        optional(
                            Submission::with('mahasiswa.user')->find(request()->query('submission_id'))
                        )->mahasiswa?->user?->name
                    )
                    ->disabled()
                    ->dehydrated(false),

                // Comment
                Textarea::make('comment')
                    ->label('Feedback')
                    ->required()
                    ->columnSpanFull(),

                // Score
                TextInput::make('score')
                    ->numeric()
                    ->required(),

                Hidden::make('dosen_id')
                    ->default(fn() => Dosen::where('user_id', Auth::id())->value('id')),
            ]);
    }
}
