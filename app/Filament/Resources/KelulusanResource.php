<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelulusanResource\Pages;
use App\Models\Kelulusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class KelulusanResource extends Resource
{
    protected static ?string $model = Kelulusan::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Data Kelulusan';

    protected static ?string $modelLabel = 'Kelulusan';

    protected static ?string $pluralModelLabel = 'Data Kelulusan';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama_siswa')
                            ->label('Nama Lengkap Siswa')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Ahmad Rizki'),

                        Forms\Components\TextInput::make('nis')
                            ->label('NIS (Nomor Induk Siswa)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->placeholder('Contoh: 2024001')
                            ->helperText('NIS ini akan digunakan sebagai TOKEN untuk cek kelulusan'),

                        Forms\Components\Select::make('jurusan_id')
                            ->label('Program Keahlian')
                            ->relationship('jurusan', 'nama_jurusan')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('tahun_lulus')
                            ->label('Tahun Kelulusan')
                            ->options(function () {
                                $currentYear = date('Y');
                                $years = [];
                                for ($i = $currentYear - 2; $i <= $currentYear + 2; $i++) {
                                    $years[$i] = $i;
                                }
                                return $years;
                            })
                            ->default(date('Y'))
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status Kelulusan')
                    ->schema([
                        Forms\Components\Select::make('status_kelulusan')
                            ->label('Status Kelulusan')
                            ->options([
                                'lulus' => '✅ Lulus',
                                'tidak_lulus' => '❌ Tidak Lulus',
                            ])
                            ->required()
                            ->default('lulus')
                            ->live(),

                        Forms\Components\Select::make('status_pembayaran')
                            ->label('Status Pembayaran Administrasi')
                            ->options([
                                'lunas' => '✅ Lunas',
                                'belum_lunas' => '⏳ Belum Lunas',
                            ])
                            ->required()
                            ->default('belum_lunas')
                            ->visible(fn(Forms\Get $get) => $get('status_kelulusan') === 'lulus')
                            ->helperText('Siswa hanya bisa download PDF jika sudah LUNAS'),

                        Forms\Components\FileUpload::make('file_pdf')
                            ->label('File PDF Kelulusan')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120) // 5MB
                            ->disk('public') // Tambahkan ini
                            ->directory('kelulusan')
                            ->visibility('public') // Tambahkan ini
                            ->visible(fn(Forms\Get $get) => in_array($get('status_kelulusan'), ['lulus', 'tidak_lulus']))
                            ->helperText('Upload file PDF kelulusan (Max 5MB)')
                            ->downloadable()
                            ->openable(),

                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->rows(3)
                            ->placeholder('Catatan tambahan (opsional)')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nis')
                    ->label('NIS (Token)')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('NIS berhasil dicopy!')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('nama_siswa')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jurusan.nama_jurusan')
                    ->label('Jurusan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('tahun_lulus')
                    ->label('Tahun')
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('status_kelulusan')
                    ->label('Status Kelulusan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'lulus' => 'success',
                        'tidak_lulus' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'lulus' => '✅ Lulus',
                        'tidak_lulus' => '❌ Tidak Lulus',
                    }),

                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->label('Status Bayar')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'lunas' => 'success',
                        'belum_lunas' => 'warning',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'lunas' => '💰 Lunas',
                        'belum_lunas' => '⏳ Belum Lunas',
                    }),

                Tables\Columns\IconColumn::make('file_pdf')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-check')
                    ->falseIcon('heroicon-o-document-minus')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_kelulusan')
                    ->label('Status Kelulusan')
                    ->options([
                        'lulus' => 'Lulus',
                        'tidak_lulus' => 'Tidak Lulus',
                    ]),

                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'lunas' => 'Lunas',
                        'belum_lunas' => 'Belum Lunas',
                    ]),

                Tables\Filters\SelectFilter::make('jurusan_id')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama_jurusan')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('tahun_lulus')
                    ->label('Tahun Lulus')
                    ->options(function () {
                        $currentYear = date('Y');
                        $years = [];
                        for ($i = $currentYear - 5; $i <= $currentYear + 2; $i++) {
                            $years[$i] = $i;
                        }
                        return $years;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Kelulusan $record) {
                        // Hapus file PDF saat record dihapus
                        if ($record->file_pdf && Storage::exists($record->file_pdf)) {
                            Storage::delete($record->file_pdf);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->file_pdf && Storage::exists($record->file_pdf)) {
                                    Storage::delete($record->file_pdf);
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelulusans::route('/'),
            'create' => Pages\CreateKelulusan::route('/create'),
            'edit' => Pages\EditKelulusan::route('/{record}/edit'),
        ];
    }
}
