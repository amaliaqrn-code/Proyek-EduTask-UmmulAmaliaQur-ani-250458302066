<?php

namespace App\Filament\Mahasiswa\Resources\Submissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class SubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assignment.title')
                    ->label('Tugas')
                    ->sortable(),
                TextColumn::make('mahasiswa.user.name')
                    ->label('Nama Lengkap')
                    ->sortable(),
                TextColumn::make('file_url')
                    ->label('File')
                    ->formatStateUsing(
                        fn($state) =>
                        $state
                            ? '<a href="' . Storage::url($state) . '" target="_blank" class="text-primary-600 underline">Lihat PDF</a>'
                            : '<span class="text-gray-400">Tidak ada file</span>'
                    )
                    ->html(),
                TextColumn::make('status'),
                TextColumn::make('points_awarded')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('points_reason')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
