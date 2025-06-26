<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    protected string $title;
    protected string $name;
    protected mixed $value;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $name, $value = null)
    {
        $this->title = $title;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input', [
            'title' => $this->title,
            'name' => $this->name,
            'value' => $this->value,
        ]);
    }
}
