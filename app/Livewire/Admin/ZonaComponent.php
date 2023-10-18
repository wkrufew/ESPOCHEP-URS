<?php

namespace App\Livewire\Admin;

use App\Models\Zone;
use Livewire\Component;
use Livewire\Attributes\On; 

class ZonaComponent extends Component
{
    public $zones, $zone;

    public $createForm = [
        'code' => ''
    ];

    public $editForm = [
        'open' => false,
        'code' => ''
    ];

    protected $validationAttributes = [
        'createForm.code' => 'code',
    ];

    public function mount(){
        $this->getZones();
    }

    public function getZones(){
        $this->zones = Zone::all();
    }

    public function save(){

        $this->validate([
            "createForm.code" => 'required|string|min:3'
        ]);

        Zone::create($this->createForm);

        $this->reset('createForm');

        $this->getZones();

        $this->dispatch('saved');
    }

    public function edit(Zone $zone){
        $this->zone = $zone;
        $this->editForm['open'] = true;
        $this->editForm['code'] = $zone->code;
    }

    public function update(){
        $this->zone->code = $this->editForm['code'];
        $this->zone->save();

        $this->reset('editForm');
        $this->getZones();
    }

    #[On('zone-delete')]
    public function provinceDelete(Zone $zone){
        $zone->delete();
        $this->getZones();
    }

    public function render()
    {
        return view('livewire.admin.zona-component')->layout('layouts.admin');
    }
}
