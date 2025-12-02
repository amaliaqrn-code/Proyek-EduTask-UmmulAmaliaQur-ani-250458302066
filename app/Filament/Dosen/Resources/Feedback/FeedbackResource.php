<?php

namespace App\Filament\Dosen\Resources\Feedback;

use App\Filament\Dosen\Resources\Feedback\Pages\CreateFeedback;
use App\Filament\Dosen\Resources\Feedback\Pages\EditFeedback;
use App\Filament\Dosen\Resources\Feedback\Pages\ListFeedback;
use App\Filament\Dosen\Resources\Feedback\Schemas\FeedbackForm;
use App\Filament\Dosen\Resources\Feedback\Tables\FeedbackTable;
use App\Models\Feedback;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $recordTitleAttribute = 'feedback';

    public static function form(Schema $schema): Schema
    {
        return FeedbackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeedbackTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFeedback::route('/'),
            'create' => CreateFeedback::route('/create'),
            'edit' => EditFeedback::route('/{record}/edit'),
        ];
    }

        protected function mutateFormDataBeforeCreate(array $data): array
    {
        $submission = \App\Models\Submission::find($data['submission_id']);

        $data['mahasiswa_id'] = $submission->mahasiswa_id;
        $data['dosen_id'] = Filament::auth()->user()->dosen->id ?? null;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $submission = \App\Models\Submission::find($data['submission_id']);

        $data['mahasiswa_id'] = $submission->mahasiswa_id;
        $data['dosen_id'] = Filament::auth()->user()->dosen->id ?? null;

        return $data;
    }

    public static function getEloquentQuery(): Builder
    {
        $courseId = Auth::user()->course->id ?? null;

        return parent::getEloquentQuery()
            ->when($courseId, fn ($q) => $q->where('course_id', $courseId));
    }
}
