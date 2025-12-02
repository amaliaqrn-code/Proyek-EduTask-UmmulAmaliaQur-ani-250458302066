<?php

namespace App\Filament\Dosen\Resources\CourseStudents;

use App\Filament\Dosen\Resources\CourseStudents\Pages\CreateCourseStudent;
use App\Filament\Dosen\Resources\CourseStudents\Pages\EditCourseStudent;
use App\Filament\Dosen\Resources\CourseStudents\Pages\ListCourseStudents;
use App\Filament\Dosen\Resources\CourseStudents\Schemas\CourseStudentForm;
use App\Filament\Dosen\Resources\CourseStudents\Tables\CourseStudentsTable;
use App\Models\CourseStudent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CourseStudentResource extends Resource
{
    protected static ?string $model = CourseStudent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CourseStudentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseStudentsTable::configure($table);
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
            'index' => ListCourseStudents::route('/'),
            'create' => CreateCourseStudent::route('/create'),
            'edit' => EditCourseStudent::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $userId = Auth::id();

        return parent::getEloquentQuery()
            ->with([
                'course',
                'mahasiswa',
                'mahasiswa.user',
            ])
            ->whereHas('course.dosen.user', function ($q) use ($userId) {
                $q->where('id', $userId);
            });
    }

}
