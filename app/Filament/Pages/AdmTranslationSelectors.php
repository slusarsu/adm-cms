<?php

namespace App\Filament\Pages;

use App\Models\AdmTranslation;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdmTranslationSelectors extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.adm-translation-selectors';

    public array $locales;
    public string $model_type;

    public $record;
    public $records;
    /**
     * @var Builder[]|Collection
     */
    public array|Collection $allTranslations;
    protected static bool $shouldRegisterNavigation = false;
    private mixed $modelClassName;

    public function mount(Request $request): void
    {
        $this->locales = admLanguages();
        $this->modelClassName = $request->model_type;
        $this->model_type = "App\Models\\".$this->modelClassName;
        $this->record = $this->model_type::query()
            ->where('id', $request->record)
            ->with('translation')
            ->first();

        $this->records = $this->getAllRecords();
        $this->addLocaleProperties();

        if(!empty($this->record->translation)) {
            $this->hash = $this->record->translation->hash;
            $this->allTranslations = $this->record->translations();
            $this->formFillRecords();
        }
    }

    public function getAllRecords()
    {
        $records =  $this->model_type::query()->where('locale', '!=', $this->record->lang);

        if($this->model_type == 'App\Models\Post') {
            $records = $records->where('type', $this->record->type);
        }

        return $records->get();
    }

    public function formFillRecords(): void
    {
        $records = [];

        foreach ($this->allTranslations as $item) {
            $records[$item->locale] = $item->model_id;
        }

        $this->form->fill($records);
    }

    private function addLocaleProperties(): void
    {
        foreach ($this->locales as $locale => $name) {
            $this->$locale = '';
        }
    }

    public function prepareSelectors(): array
    {
        $allRecords = $this->getAllRecords();
        $formSelectors = [];

        foreach ($this->locales as $locale => $name) {
            $records = $allRecords?->where('locale', $locale)->pluck('title', 'id')->all();

            if(!$records) continue;

            $formSelectors[] = Select::make($locale)
                ->label($name)
                ->options($records)
                ->searchable();
        }

        return $formSelectors;
    }

    public function removeAllOldRelations($ids): void
    {
        AdmTranslation::query()
            ->where('model_type', $this->model_type)
            ->whereIn('model_id', $ids)
            ->delete();
    }

    public function createRelations($languages): void
    {
        $hash = Str::uuid();
        foreach ($languages as $lang => $model_id) {
            if(!$model_id) {
                continue;
            }
            AdmTranslation::query()->updateOrCreate(
                [
                    'model_type' => $this->model_type,
                    'model_id' => $model_id,
                    'locale' => $lang,
                ],
                [
                    'hash' => $hash,
                ]
            );
        }
    }

    public function submit(): void
    {
        $languages = $this->form->getState();
        $languages[$this->record->locale] = $this->record->id;

        $this->removeAllOldRelations($languages);
        $this->createRelations($languages);

        Notification::make()
            ->title('Saved successfully')
            ->icon('heroicon-o-sparkles')
            ->iconColor('success')
            ->send();

        $this->redirect(url()->previous());
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Map Translations')->schema($this->prepareSelectors())
        ];

    }
}
