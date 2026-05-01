<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Schema;





class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Post Details")
                ->description("Fill in the details of the post")
                ->icon('heroicon-o-document-text')
                ->schema([
                    Group::make([
                        TextInput::make("title")
                            ->required()
                            ->rule(['min:5', 'max: 10']),
                        TextInput::make("slug")
                            ->required()
                            ->unique()
                            ->minLength(3)
                            ->validationMessages([
                                "unique" => "Slug must be unique"
                            ]),
                        Select::make('category_id')
                            ->relationship("category", "name")
                            ->options(Category::all()->pluck("name", "category_id"))
                            ->required()
                            // ->preload()
                            ->searchable()
                            ->validationMessages([
                                "required" => "Category must be selected"
                            ]),
                        ColorPicker::make('color'),
                    ])->columns(2),

                    MarkdownEditor::make("body")
                ])->columnSpan(2),

                Group::make([
                    Section::make("Image Upload")
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make("image")
                            ->disk("public")
                            ->directory("posts")
                            ->required()
                    ]),

                    Section::make("Meta Information")
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        TagsInput::make("tags"),
                        Checkbox::make("published"),
                        DateTimePicker::make("published_at")
                    ]),
                ])->columnSpan(1),
        ])->columns(3);
    }
}
