<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationGroup = 'Tools';
    protected static ?string $navigationIcon = 'heroicon-o-chat';

    protected static ?int $navigationSort = 4;

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.comments');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.comments');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.comment');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('email')
                        ->label(trans('dashboard.email'))
                        ->email(true)
                        ->maxLength(255),

                    Textarea::make('content')
                        ->label(trans('dashboard.content'))
                        ->required(),

                    TextInput::make('parent_id')
                        ->label(trans('dashboard.parent'))
                        ->numeric(true),

                    Toggle::make('is_enabled')
                        ->label(trans('dashboard.enabled'))
                        ->default(false)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('email')
                    ->label(trans('dashboard.email'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('content')
                    ->label(trans('dashboard.content'))
                    ->limit(150, '...')
                    ->searchable(),
                TextColumn::make('commentable_type')
                    ->sortable(),
                TextColumn::make('commentable_id')
                    ->sortable(),
                TextColumn::make('ip')
                    ->sortable(),
                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('only_enabled')
                    ->label(trans('dashboard.only_enabled'))
                    ->query(fn (Builder $query): Builder => $query->where('is_enabled', true))
                    ->toggle(),
                SelectFilter::make('email')
                    ->options(
                        Comment::query()->pluck('email', 'email')->unique()->toArray()
                    )
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
