<?php

namespace App\Livewire\Admin;

use App\Models\Sticker;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class StickerListar extends Component
{
    use WithPagination;
    public $search = '';
    public $selectedSticker = null;
    public $stickerInfo = null;

    public function updatingSearch(){
        $this->resetPage();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $stickers = Sticker::where('code', 'LIKE', "%$this->search%")->paginate(10);
        return view('livewire.admin.sticker-listar', compact('stickers'));
    }
}
