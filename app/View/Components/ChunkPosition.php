<?php

namespace App\View\Components;

use App\Adm\Services\ChunkService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChunkPosition extends Component
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public array|\Illuminate\Database\Eloquent\Collection $chunks;

    /**
     * Create a new component instance.
     */
    public function __construct(string $position)
    {
        $this->chunks = ChunkService::getAllByPosition($position);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('adm::components.chunk-position');
    }
}
