<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuplierResource\Pages;
use App\Filament\Resources\SuplierResource\RelationManagers;
use App\Models\Suplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuplierResource extends Resource
{
    protected static ?string $model = Suplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $label = 'Data Supplier';

    public static function getFrom(){
        return[
            Forms\Components\TextInput::make('nama_perusahaan'),
            Forms\Components\TextInput::make('nama')
                ->label('Nama Kontak')
                ->required()
                ->minLength(3),
            Forms\Components\TextInput::make('no_hp')
                ->label('Nomor Handphone')->type('number'),
            Forms\Components\TextInput::make('email')->type('email'),
            Forms\Components\TextInput::make('alamat')->columnSpanFull(),
            Forms\Components\TextInput::make('alamat_pribadi')->columnSpanFull(),
      
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                self::getFrom()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_perusahaan')->searchable(),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->searchable()->label('Nomor Handphone'),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('alamat')->searchable(),
              
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSupliers::route('/'),
            'create' => Pages\CreateSuplier::route('/create'),
            'edit' => Pages\EditSuplier::route('/{record}/edit'),
        ];
    }
}
