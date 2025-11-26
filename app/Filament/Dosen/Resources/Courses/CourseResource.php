<?php

namespace App\Filament\Dosen\Resources\Courses;

use App\Filament\Dosen\Resources\Courses\Pages\CreateCourse;
use App\Filament\Dosen\Resources\Courses\Pages\EditCourse;
use App\Filament\Dosen\Resources\Courses\Pages\ListCourses;
use App\Filament\Dosen\Resources\Courses\Schemas\CourseForm;
use App\Filament\Dosen\Resources\Courses\Tables\CoursesTable;
use App\Models\Course;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'course';

    public static function form(Schema $schema): Schema
    {
        return CourseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoursesTable::configure($table);
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
            'index' => ListCourses::route('/'),
            'create' => CreateCourse::route('/create'),
            'edit' => EditCourse::route('/{record}/edit'),
        ];
    }

   public static function getEloquentQuery(): Builder
    {
        $dosenId = Auth::user()->dosen->id ?? null;

        return parent::getEloquentQuery()
            ->when($dosenId, fn ($q) => $q->where('dosen_id', $dosenId));
    }

}
