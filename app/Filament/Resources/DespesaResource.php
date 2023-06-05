<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DespesaResource\Pages;
use App\Filament\Resources\DespesaResource\RelationManagers;
use App\Models\Despesa;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DespesaResource extends Resource
{
    protected static ?string $model = Despesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('despesas')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('valor'),
                Forms\Components\DatePicker::make('vencimento'),
                Forms\Components\Toggle::make('status'),
                Forms\Components\DatePicker::make('pagamento'),
                Forms\Components\TextInput::make('obs')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('despesas'),
                Tables\Columns\TextColumn::make('valor'),
                Tables\Columns\TextColumn::make('vencimento')
                    ->date(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('pagamento')
                    ->date(),
                Tables\Columns\TextColumn::make('obs'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListDespesas::route('/'),
            'create' => Pages\CreateDespesa::route('/create'),
            'view' => Pages\ViewDespesa::route('/{record}'),
            'edit' => Pages\EditDespesa::route('/{record}/edit'),
        ];
    }    
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
