<?php

namespace App\Http\Livewire\Panel\Shooting;

use App\Models\Shooting;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShootCounter extends Component
{
    /**
     * @var Shooting
     */
    public Shooting $shooting;

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.panel.shooting.shoot-counter');
    }
}
