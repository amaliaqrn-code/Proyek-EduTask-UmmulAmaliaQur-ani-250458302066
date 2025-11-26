<?php

namespace App\Filament\Resources\CourseStudents;

use App\Filament\Resources\CourseStudents\Pages\CreateCourseStudent;
use App\Filament\Resources\CourseStudents\Pages\EditCourseStudent;
use App\Filament\Resources\CourseStudents\Pages\ListCourseStudents;
use App\Filament\Resources\CourseStudents\Pages\ViewCourseStudent;
use App\Filament\Resources\CourseStudents\Schemas\CourseStudentForm;
use App\Filament\Resources\CourseStudents\Schemas\CourseStudentInfolist;
use App\Filament\Resources\CourseStudents\Tables\CourseStudentsTable;
use App\Models\CourseStudent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourseStudentResource extends Resource
{
    protected static ?string $model = CourseStudent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static ?string $recordTitleAttribute = 'CourseStudent';

    public static function form(Schema $schema): Schema
    {
        return CourseStudentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseStudentInfolist::configure($schema);
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
            'view' => ViewCourseStudent::route('/{record}'),
            'edit' => EditCourseStudent::route('/{record}/edit'),
        ];
    }
}
