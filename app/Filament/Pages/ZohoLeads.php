<?php

namespace App\Filament\Pages;

use App\Filament\Support\PanelNavigationGroup;
use App\Services\ZohoLeadService;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Throwable;

class ZohoLeads extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCloud;

    protected string $view = 'filament.pages.zoho-leads';

    /**
     * @var array<int, array<string, string|null>>
     */
    public array $leads = [];

    public ?string $zohoError = null;

    public static function getNavigationLabel(): string
    {
        return 'Zoho CRM Leads';
    }

    public static function getNavigationGroup(): ?string
    {
        return PanelNavigationGroup::Leads->label();
    }

    public static function getNavigationSort(): ?int
    {
        return 20;
    }

    public function mount(): void
    {
        try {
            foreach (app(ZohoLeadService::class)->getLeadsData() as $record) {
                $this->leads[] = [
                    'first_name' => $record->getKeyValue('First_Name'),
                    'last_name' => $record->getKeyValue('Last_Name'),
                    'email' => $record->getKeyValue('Email'),
                    'phone' => $record->getKeyValue('Phone'),
                    'description' => $record->getKeyValue('Description'),
                ];
            }
        } catch (Throwable $exception) {
            report($exception);
            $this->zohoError = $exception->getMessage();
        }
    }

    public function table(Table $table): Table
    {
        // The Leads module is read via the SDK, not Eloquent, so search, sort and pagination are
        // applied to the fetched array here.
        return $table
            ->heading('Zoho CRM leads')
            ->description('Read-only mirror of the Zoho CRM Leads module.')
            ->records(function (?string $search, ?string $sortColumn, ?string $sortDirection, int|string $recordsPerPage, int|string $page): Paginator {
                $records = collect($this->leads);

                if (filled($search)) {
                    $records = $records->filter(fn (array $lead): bool => Str::contains(
                        Str::lower(implode(' ', $lead)),
                        Str::lower($search),
                    ));
                }

                if (filled($sortColumn)) {
                    $records = $records->sortBy(
                        fn (array $lead): string => (string) ($lead[$sortColumn] ?? ''),
                        SORT_NATURAL | SORT_FLAG_CASE,
                        $sortDirection === 'desc',
                    );
                }

                return new LengthAwarePaginator(
                    $records->forPage((int) $page, (int) $recordsPerPage)->values(),
                    $records->count(),
                    (int) $recordsPerPage,
                    (int) $page,
                );
            })
            ->columns([
                TextColumn::make('first_name')
                    ->label('First name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('last_name')
                    ->label('Last name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('description')
                    ->wrap()
                    ->lineClamp(3)
                    ->tooltip(fn (array $record): ?string => $record['description']),
            ])
            ->paginated([10, 25, 50])
            ->defaultSort('last_name')
            ->emptyStateHeading('No leads in Zoho CRM');
    }
}
