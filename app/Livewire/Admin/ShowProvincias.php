<?php

namespace App\Livewire\Admin;

use App\Models\Canton;
use App\Models\Province;
use Livewire\Component;
use Livewire\Attributes\On; 

class ShowProvincias extends Component
{
    public $province, $cantones, $canton;

    public $createForm = [
        'name' => '',
        'code' => null
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        'code' => null
    ];

    protected $validationAttributes = [
        'createForm.name' => 'name',
        'createForm.code' => 'code'
    ];


    public function mount(Province $province){
        $this->province = $province;
        $this->getCantons();
    }

    public function getCantons(){
        $this->cantones = Canton::where('province_id', $this->province->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required',
            "createForm.code" => 'required|string|min:2',
        ]);

        $this->province->cantons()->create($this->createForm);


        $this->reset('createForm');

        $this->getCantons();

        $this->dispatch('saved');
    }

    public function edit(Canton $canton){
        $this->canton = $canton;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $canton->name;
        $this->editForm['code'] = $canton->code;
    }

    public function update(){
        $this->canton->name = $this->editForm['name'];
        $this->canton->code = $this->editForm['code'];
        $this->canton->save();

        $this->reset('editForm');
        $this->getCantons();
    }

    #[On('canton-delete')]
    public function cantonDelete(Canton $canton){
        $canton->delete();
        $this->getCantons();
    }

    public function render()
    {
        return view('livewire.admin.show-provincias')->layout('layouts.admin');
    }
}
