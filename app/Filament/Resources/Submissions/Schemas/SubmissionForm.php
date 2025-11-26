<?php

namespace App\Filament\Resources\Submissions\Schemas;

use App\Models\User;
use App\Models\Assignment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class SubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('assignment_id')
                    ->label('Assignment')
                    ->relationship('assignment', 'title')
                    ->getOptionLabelFromRecordUsing(
                        fn (\App\Models\Assignment $record) =>
                            $record->title . ' - ' . $record->course->name
                    )
                    ->required(),

                Select::make('mahasiswa_id')
                    ->label('Created By')
                    ->required()
                    ->options(fn () =>
                        User::where('role', 'mahasiswa')->pluck('name', 'id')
                    ),

                DateTimePicker::make('submitted_at')
                    ->disabled(),

                 FileUpload::make('file_url')
                ->label('Upload File (PDF / PPT / DOC)')
                ->directory('assignments')
                ->preserveFilenames()
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ])
                ->getUploadedFileNameForStorageUsing(function ($file) {
                    return $file->getClientOriginalName();
                })
                ->afterStateUpdated(function ($state, callable $set, callable $get) {

                    if (!$state) return;

                    // Ambil assignment yg dikerjakan
                    $assignment = Assignment::find($get('assignment_id'));
                    $deadline = $assignment->deadline;
                    $now = now();

                    // Convert path → URL
                    $url = asset('storage/' . $state);
                    $set('file_url', $url);

                    // submitted by (mahasiswa yg login)
                    $set('submitted_by', Auth::id());

                    // waktu submit
                    $set('submitted_at', $now);

                    // cek telat atau tidak
                    if ($now->lessThanOrEqualTo($deadline)) {
                        $set('status', 'submitted');
                        $set('points_awarded', 5);
                        $set('points_reason', 'Submitted on time');
                    } else {
                        $set('status', 'late');
                        $set('points_awarded', 2);
                        $set('points_reason', 'Submitted late');
                    }
                }),

                Select::make('status')
                    ->options([
                        'submitted' => 'Submitted',
                        'late' => 'Late',
                        'not_submitted' => 'Not submitted'
                    ])
                    ->default('not_submitted')
                    ->disabled(), // supaya tidak bisa diedit manual

                TextInput::make('points_awarded')
                    ->numeric()
                    ->default(null)
                    ->disabled(),

                TextInput::make('points_reason')
                    ->default(null)
                    ->disabled(),
            ]);
    }
}
