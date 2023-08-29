<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdmTopBar extends Component
{
    /**
     * Create a new component instance.
     */
    public string $editUrl;

    public array $pageTypes = [
      'App\Models\Page' => 'page',
      'App\Models\Post' => 'post',
      'App\Models\Tag' => 'tag',
      'App\Models\Category' => 'category',
    ];

    public array $pluralPageTypes = [
        'page' => 'pages',
        'post' => 'posts',
        'tag' => 'tags',
        'category' => 'categories',
    ];

    public bool $isEditable = false;

    public string $slug = '';

    public string $pageType = '';
    public string $pluralTypeName = '';
    public $record;
    public function __construct()
    {
        $this->editUrl = $this->editUrl();
    }

    public function checkPage(): bool
    {
        $pathArr = explode('/', request()->path());

        if(empty($pathArr)) {
            return false;
        }

        if(!empty($pathArr[0]) && empty($pathArr[1]) && $pathArr[0] !== 'adm-search' ) {
            $this->slug = $pathArr[0];
            $this->pageType = 'page';
            $this->isEditable = true;
        }

        if(!empty($pathArr[0]) && !empty($pathArr[1])) {
            $this->slug = $pathArr[1];
            $this->pageType = $pathArr[0];
            $this->isEditable = true;
        }

        if(!in_array($this->pageType, $this->pageTypes)) {
            $this->slug = '';
            $this->pageType = '';
            $this->isEditable = false;
        }

        return true;
    }

    public function editUrl(): bool
    {
        if(!$this->checkPage()) {
            $this->isEditable = false;
            return '';
        }
        $model = array_search($this->pageType, $this->pageTypes);
        if(!$model) {
            $this->isEditable = false;
            return '';
        }

        $this->record = resolve($model)->query()->where('slug', $this->slug)->first();

        if(!$this->record ) {
            $this->isEditable = false;
            return '';
        }
        $this->pluralTypeName = $this->pluralPageTypes[$this->pageType];
        return '/admin/'.$this->pluralTypeName.'/'.$this->record->id.'/edit';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('adm::components.adm-topbar');
    }
}
