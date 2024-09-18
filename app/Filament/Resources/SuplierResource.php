<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Suplier;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuplierResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuplierResource\RelationManagers;

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
                Tables\Actions\Action::make('pdf') 
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-o-document-text')
                ->action(function (Suplier $record) {
                    return response()->streamDownload(function () use ($record) {
                        echo Pdf::loadHtml(
                            Blade::render('suplier', ['record' => $record])
                        )->stream();
                    }, $record->nama_perusahaan . '.pdf');
                }), 
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
