<?php

namespace App\View\Components;

use App\Adm\Services\ChunkService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chunk extends Component
{
    public $chunk;

    /**
     * Create a new component instance.
     */
    public function __construct(string $slug)
    {
        $this->chunk = ChunkService::getOneBySlug($slug);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('adm::components.chunk');
    }
}
