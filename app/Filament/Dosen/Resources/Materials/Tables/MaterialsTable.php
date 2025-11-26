<?php

namespace App\Filament\Dosen\Resources\Materials\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class MaterialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course.name')
                    ->label('Mata Kuliah')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul Tugas')
                    ->searchable(),
                TextColumn::make('file_url')
                    ->label('File')
                    ->formatStateUsing(
                        fn($state) =>
                        $state
                            ? '<a href="' . Storage::url($state) . '" target="_blank" class="text-primary-600 underline">Lihat PDF</a>'
                            : '<span class="text-gray-400">Tidak ada file</span>'
                    )
                    ->html(),
                TextColumn::make('dosen.user.name')
                    ->label('Nama Dosen')
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
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
