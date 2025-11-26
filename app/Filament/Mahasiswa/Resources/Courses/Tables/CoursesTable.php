<?php

namespace App\Filament\Mahasiswa\Resources\Courses\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('dosen.user.name')
                    ->label('Dosen')
                    ->sortable(),
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
                Action::make('ambil')
                ->label(fn($record) =>
                    Filament::auth()->user()->courses->contains($record->id)
                    ? 'Sudah Diambil'
                    : 'Ambil'
                )
                ->action(function ($record) {
                    Filament::auth()->user()->courses()->attach($record->id);
                })
                ->disabled(fn($record) =>
                    Filament::auth()->user()->courses->contains($record->id)
                )
                ->color(fn($record) =>
                    Filament::auth()->user()->courses->contains($record->id)
                        ? 'gray'
                        : 'primary'
                ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
