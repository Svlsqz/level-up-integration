<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Password;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ToggleColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context) => $context === 'create')
                    ->maxLength(255),

                Select::make('role')
                    ->required()
                    ->options([
                        'admin' => 'Admin',
                        'mentor' => 'Mentor',
                        'student' => 'Student',
                    ]),

                Select::make('entity_id')
                    ->label('Entity')
                    ->relationship('entity', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Toggle::make('is_visible')
                    ->label('Visible'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                BadgeColumn::make('role')->colors([
                    'primary' => 'student',
                    'success' => 'mentor',
                    'danger' => 'admin',
                ]),
                ToggleColumn::make('is_visible')->label('Visible'),
                TextColumn::make('level')
                    ->label('Level')
                    ->getStateUsing(fn(User $record) => $record->getLevel()),
                TextColumn::make('xp')
                    ->label('XP')
                    ->getStateUsing(fn(User $record) => $record->getPoints()),
                TextColumn::make('entity.name')->label('Entity')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'mentor' => 'Mentor',
                        'student' => 'Student',
                    ]),
                Tables\Filters\TernaryFilter::make('is_visible')->label('Visible'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
