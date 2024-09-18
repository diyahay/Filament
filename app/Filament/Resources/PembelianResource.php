<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Suplier;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Pembelian;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Forms\FormsComponent;
use Illuminate\Support\Facades\Blade;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PembelianResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PembelianResource\RelationManagers;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $label = 'Data Pembelian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                        ->label('Tanggal Pembelian')
                        ->required()
                        ->default(now())->columnSpanFull(),
                Forms\Components\Select::make('suplier_id')
                    ->options(
                        \App\Models\Suplier::pluck('nama_perusahaan','id')
                    )->required()
                    ->label('Pilih Supplier')
                    ->searchable()
                    ->createOptionForm(
                        \App\Filament\Resources\SuplierResource::getFrom()
                    )
                    ->createOptionUsing(function (array $data): int {
                        return \App\Models\Suplier::create($data)->id;
                    })
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $suplier = \App\Models\Suplier::find($state);
                        $set('email',$suplier->email ?? null);
                    }),
                Forms\Components\TextInput::make('email')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Suplier.nama_perusahaan')
                    ->label('Nama Supplier'),
                TextColumn::make('Suplier.nama')
                    ->label('Nama Penghubung'),
                TextColumn::make('tanggal')->dateTime('d F Y')
                     ->label('Tanggal Pembelian'),
                     //->formatStateUsing(fn (string $state): string => \Carbon\Carbon::parse($state)->format('d F Y')),
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
                ->action(function (Pembelian $record) {
                    return response()->streamDownload(function () use ($record) {
                        echo Pdf::loadHtml(
                            Blade::render('pembelian', ['record' => $record])
                        )->stream();
                    }, $record->tanggal . '.pdf');
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
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}
