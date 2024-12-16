<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationBanner extends Component
{
    public string $message;
    /**
     * Create a new component instance.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-banner');
    }
}
