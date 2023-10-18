<?php

namespace App\Livewire\Admin;

use App\Models\Sector;
use App\Models\Zone;
use Livewire\Component;
use Livewire\Attributes\On; 

class ShowZona extends Component
{
    public $zone, $sectors, $sector;

    public $createForm = [
        'code' => '',
    ];

    public $editForm = [
        'open' => false,
        'code' => '',
    ];

    protected $validationAttributes = [
        'createForm.code' => 'code'
    ];


    public function mount(Zone $zone){
        $this->zone = $zone;
        $this->getSectors();
    }

    public function getSectors(){
        $this->sectors = Sector::where('zone_id', $this->zone->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.code" => 'required|string|min:3',
        ]);

        $this->zone->sectors()->create($this->createForm);


        $this->reset('createForm');

        $this->getSectors();

        $this->dispatch('saved');
    }

    public function edit(Sector $sector){
        $this->sector = $sector;
        $this->editForm['open'] = true;
        $this->editForm['code'] = $sector->code;
    }

    public function update(){
        $this->sector->code = $this->editForm['code'];
        $this->sector->save();

        $this->reset('editForm');
        $this->getSectors();
    }

    #[On('sector-delete')]
    public function cantonDelete(Sector $sector){
        $sector->delete();
        $this->getSectors();
    }
    
    public function render()
    {
        return view('livewire.admin.show-zona')->layout('layouts.admin');
    }
}
