<?php

namespace App\Filament\Dosen\Resources\Feedback\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FeedbackTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('submission.assignment.title')
                    ->label('Judul Tugas')
                    ->sortable()
                    ->getStateUsing(fn ($record) => $record->submission?->assignment?->title ?? 'Tidak Ada'),

                TextColumn::make('dosen.user.name')
                    ->label('Nama Dosen')
                    ->sortable()
                    ->getStateUsing(fn ($record) => $record->dosen?->user?->name ?? 'Tidak Ada'),

                TextColumn::make('mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->sortable()
                    ->getStateUsing(fn ($record) => $record->mahasiswa?->user?->name ?? 'Tidak Ada'),

                TextColumn::make('score')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
            \Filament\Actions\Action::make('export_csv')
            ->label('Export CSV')
            ->icon('heroicon-o-arrow-down-tray')
            ->action(function () {
                $fileName = 'feedback_export.csv';

                return new \Symfony\Component\HttpFoundation\StreamedResponse(function () {
                    $handle = fopen('php://output', 'w');

                    // Header CSV
                    fputcsv($handle, [
                        'Nama Mahasiswa',
                        'Skor',
                        'Judul Tugas',
                    ]);

                    // Ambil data (dengan relasi)
                    $records = \App\Models\Feedback::with([
                        'mahasiswa.user',
                        'submission.assignment',
                    ])->get();

                    foreach ($records as $record) {
                        fputcsv($handle, [
                            $record->mahasiswa?->user?->name ?? 'Tidak Ada',
                            $record->score ?? '-',
                            $record->submission?->assignment?->title ?? 'Tidak Ada',
                        ]);
                    }

                    fclose($handle);
                }, 200, [
                    "Content-Type" => "text/csv",
                    "Content-Disposition" => "attachment; filename={$fileName}"
                ]);
            }),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Eager load relasi supaya semua kolom muncul
    public static function getTableQuery(): Builder
    {
        return \App\Models\Feedback::query()
            ->with(['submission.assignment', 'dosen.user', 'mahasiswa.user']);
    }
}
