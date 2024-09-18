<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\RelationManagers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $label= 'Data Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('kode')
                ->required(),
            TextInput::make('nama')
                ->label('Nama Barang'),
            TextInput::make('harga')
                ->label('Harga Barang'),
            TextInput::make('stok')
                ->disabledOn('edit')
                ->label('Stok Awal'),
            Select::make('satuan')
                ->options([
                    'pcs' => 'Pcs',
                    'kg' => 'Kg',
                    'lusin' => 'Lusin',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')->searchable(),
                TextColumn::make('nama')->searchable(),
                TextColumn::make('harga')
                ->formatStateUsing(fn (string $state): string => 'Rp ' . number_format($state, 0, ',', '.'))
                ->searchable(),
                TextColumn::make('stok')->searchable(),
                TextColumn::make('satuan'),

            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                Tables\Actions\Action::make('pdf') 
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-o-document-text')
                ->action(function (Barang $record) {
                    return response()->streamDownload(function () use ($record) {
                        echo Pdf::loadHtml(
                            Blade::render('barang', ['record' => $record])
                        )->stream();
                    }, $record->kode . '.pdf');
                }), 
            ])
            ->bulkActions([
               BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
