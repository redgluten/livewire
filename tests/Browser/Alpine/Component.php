<?php

namespace Tests\Browser\Alpine;

use Illuminate\Support\Facades\View;
use Livewire\Component as BaseComponent;

class Component extends BaseComponent
{
    public $count = 0;

    public $nested = [
        'count' => 0,
    ];

    public function incrementNestedCount()
    {
        $this->nested['count'] = $this->nested['count'] + 1;
    }

    public function setCount($value)
    {
        $this->count = $value;
    }

    public function dispatchSomeEvent()
    {
        $this->dispatchBrowserEvent('some-event', 'bar');
    }

    public function returnValue($value)
    {
        return $value;
    }

    public function updatingCount($value)
    {
        if ($value === 100) usleep(10 * 1000);

        if ($this->count === 100) throw new \Exception('"count" shouldnt already be "100". This means @entangle made an extra request after Livewire set the data.');
    }

    public function render()
    {
        return View::file(__DIR__.'/view.blade.php');
    }
}
