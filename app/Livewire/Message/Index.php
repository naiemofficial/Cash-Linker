<?php

namespace App\Livewire\Message;

use App\Helpers\Response;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $className = null;
    #[On('refresh-message')]
    public function refreshMessage($response, $className = null){
        $this->className = $className ?? $this::class;
        Response::visualize($this->className, $response, [
            'session-flash' => true,
            'template' => [
                'key' => 'textOnly',
                'wrapper' => true,
                'key-based-color' => true,
                'class' => 'line-clamp-1 px-2 py-0.5 border-[1px] border-solid rounded-[20px] text-center max-w-[500px]'
            ]
        ]);
    }

    public function render()
    {
        return view('livewire.message.index', [
            'className' => $this->className
        ]);
    }
}
