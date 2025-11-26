<?php

namespace App\Filament\Mahasiswa\Resources\Assignments\Tables;

use App\Filament\Dosen\Resources\Submissions\Pages\CreateSubmission;
use App\Filament\Mahasiswa\Resources\Submissions\SubmissionResource;
use App\Models\Assignment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssignmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course.name')
                    ->label('Mata Kuliah')
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('deadline')
                    ->dateTime()
                    ->sortable(),
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
                Action::make('submit')
                    ->label('Kumpulkan Tugas')
                    ->icon('heroicon-s-paper-airplane')
                    ->color('success')
                    ->url(fn ($record) =>
                    SubmissionResource::getUrl('create', ['assignment_id' => $record->id])
            ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
