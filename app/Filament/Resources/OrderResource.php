<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Filament\Forms\Get;
use Filament\Forms\Set;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Shop Management';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Orders';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('order_status', 'waiting_quote')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Order Information')
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('Order ID')
                                    ->disabled()
                                    ->dehydrated(),
                                
                                Forms\Components\Select::make('order_status')
                                    ->label('Status')
                                    ->options([
                                        'waiting_quote' => 'Waiting Quote (Cargo)',
                                        'waiting_payment' => 'Waiting Payment',
                                        'processing' => 'Processing (Paid)',
                                        'shipped' => 'Shipped',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Set $set) => 
                                        $state === 'processing' ? $set('paid_at', now()) : null
                                    ),

                                Forms\Components\Select::make('payment_status')
                                    ->options([
                                        'unpaid' => 'Unpaid',
                                        'paid' => 'Paid',
                                        'failed' => 'Failed',
                                    ])
                                    ->default('unpaid')
                                    ->required(),

                                Forms\Components\Select::make('payment_method')
                                    ->options([
                                        'midtrans' => 'Midtrans Payment Gateway',
                                    ])
                                    ->default('midtrans')
                                    ->disabled()
                                    ->dehydrated(),
                            ])->columns(2),

                        Forms\Components\Section::make('Shipping Details')
                            ->schema([
                                Forms\Components\TextInput::make('shipping_name')->required(),
                                Forms\Components\TextInput::make('shipping_phone')->required(),
                                Forms\Components\Textarea::make('shipping_address')->columnSpanFull()->required(),
                                Forms\Components\TextInput::make('shipping_city')->required(),
                                Forms\Components\TextInput::make('shipping_province')->required(),
                                Forms\Components\TextInput::make('shipping_postal_code'),
                                Forms\Components\TextInput::make('tracking_number')
                                    ->label('Resi Pengiriman')
                                    ->suffixIcon('heroicon-m-truck')
                                    ->helperText('Input resi setelah barang dikirim via Cargo/Ekspedisi.'),
                            ])->columns(2),
                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Cost Calculation')
                            ->schema([
                                Forms\Components\TextInput::make('total_product_price')
                                    ->label('Subtotal Product')
                                    ->prefix('Rp')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(),

                                Forms\Components\TextInput::make('shipping_price')
                                    ->label('Shipping Cost')
                                    ->prefix('Rp')
                                    ->numeric()
                                    ->default(0)
                                    ->live(onBlur: true) 
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $subtotal = (int) $get('total_product_price');
                                        $ongkir = (int) $state;
                                        $set('grand_total', $subtotal + $ongkir);
                                    }),

                                Forms\Components\TextInput::make('grand_total')
                                    ->label('Grand Total')
                                    ->prefix('Rp')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                            
                        Forms\Components\Section::make('Admin Notes')
                            ->schema([
                                Forms\Components\Textarea::make('notes')
                                    ->label('Internal / Customer Notes')
                                    ->placeholder('Catatan khusus untuk order ini...'),
                            ]),

                        Forms\Components\Section::make('Metadata')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Order $record): ?string => $record->created_at?->diffForHumans()),
                                
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last Modified')
                                    ->content(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                Tables\Columns\TextColumn::make('shipping_name')
                    ->label('Customer')
                    ->searchable()
                    ->description(fn(Order $record) => $record->shipping_city ?? '-'),

                Tables\Columns\TextColumn::make('grand_total')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'paid' => 'success',
                        'unpaid' => 'warning',
                        'failed' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('order_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'waiting_quote' => 'danger',    
                        'waiting_payment' => 'warning', 
                        'processing' => 'info',      
                        'shipped' => 'primary',       
                        'completed' => 'success',      
                        'cancelled' => 'gray',         
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\Action::make('input_ongkir')
                    ->label('Input Ongkir')
                    ->icon('heroicon-m-currency-dollar')
                    ->color('warning')
                    ->visible(fn (Order $record) => $record->order_status === 'waiting_quote')
                    ->form([
                        Forms\Components\TextInput::make('shipping_price')
                            ->label('Biaya Ongkir Cargo (Rp)')
                            ->numeric()
                            ->required()
                            ->prefix('Rp')
                            ->helperText('Masukkan nominal ongkir real dari ekspedisi.'),
                        
                        Forms\Components\Textarea::make('notes')
                            ->label('Pesan untuk Customer')
                            ->placeholder('Contoh: Pengiriman menggunakan Dakota Cargo, estimasi 7 hari.'),
                    ])
                    ->action(function (Order $record, array $data) {
                        // Update Data
                        $record->update([
                            'shipping_price' => $data['shipping_price'],
                            'grand_total' => $record->total_product_price + $data['shipping_price'],
                            'order_status' => 'waiting_payment',
                            'notes' => $data['notes'],
                        ]);
                        
                        Notification::make()
                            ->title('Ongkir Disimpan & Status Updated')
                            ->body('Order sekarang berstatus Waiting Payment. Customer bisa melanjutkan pembayaran.')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('update_resi')
                    ->label('Kirim Resi')
                    ->icon('heroicon-m-truck')
                    ->color('primary')
                    ->visible(fn (Order $record) => in_array($record->order_status, ['processing', 'shipped']))
                    ->form([
                        Forms\Components\TextInput::make('tracking_number')
                            ->label('Nomor Resi')
                            ->required(),
                        Forms\Components\TextInput::make('shipping_courier')
                            ->label('Nama Kurir/Ekspedisi')
                            ->default('JNE Trucking'),
                    ])
                    ->action(function (Order $record, array $data) {
                        $record->update([
                            'tracking_number' => $data['tracking_number'],
                            'shipping_courier' => $data['shipping_courier'],
                            'order_status' => 'shipped',
                        ]);
                        
                        Notification::make()->title('Resi Berhasil Diupdate')->success()->send();
                    }),

                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}