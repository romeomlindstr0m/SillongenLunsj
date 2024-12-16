<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthenticationFailure extends Component
{
    public array $messages;
    /**
     * Create a new component instance.
     */
    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.authentication-failure');
    }
}