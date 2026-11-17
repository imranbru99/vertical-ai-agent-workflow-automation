<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                TextInput::make('password')->password()->dehydrated(fn ($state) => filled($state))->required(fn (string $operation) => $operation === 'create'),
                Select::make('role')->options(UserRole::options())->required(),
                TextInput::make('company'),
                TextInput::make('job_title'),
                Toggle::make('is_active')->default(true),
                DateTimePicker::make('last_login_at'),
            ]);
    }
}
