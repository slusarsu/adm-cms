<?php

namespace App\Filament\Pages;

use App\Models\AdmTranslation;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\ActionGroup;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
        } else {
            $records[$this->record->locale] = $this->record->id;
            $this->form->fill($records);
        }
    }

    public function getAllRecords()
    {
        $records =  $this->model_type::query()->where('locale', '!=', $this->record->lang);

        if(!empty($this->record->type)) {
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

    private function getDefaultRecord($locale)
    {
        if($locale !== $this->record->locale) {
            return null;
        }

        return $this->record->id;
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

    protected function getActions(): array
    {
        return [

            Action::make(trans('dashboard.clear_this_translation'))
                ->action(function () {
                    AdmTranslation::query()
                        ->where('model_type', $this->model_type)
                        ->where('model_id', $this->record->id)
                        ->delete();

                    Notification::make()
                        ->title('Successfully')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->color('danger'),


            Action::make(trans('dashboard.clear_all_connected_translation'))
                ->action(function () {
                    if(empty($this->record->translation->hash)){
                        Notification::make()
                            ->title('Not Found')
                            ->danger()
                            ->send();

                        return;
                    }

                    AdmTranslation::query()
                        ->where('model_type', $this->model_type)
                        ->where('hash', $this->record->translation->hash)
                        ->delete();

                    Notification::make()
                        ->title('Successfully')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->color('danger'),
        ];
    }
}
