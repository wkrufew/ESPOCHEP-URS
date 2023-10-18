<?php

namespace App\Livewire\Admin;

use App\Models\Province;
use Livewire\Component;
use Livewire\Attributes\On; 

class ProvinciaComponent extends Component
{
    public $provinces, $province;

    public $createForm = [
        'name' => '',
        'code' => ''
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        'code' => ''
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.code' => 'code',
    ];

    public function mount(){
        $this->getProvinces();
    }

    public function getProvinces(){
        $this->provinces = Province::all();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required',
            "createForm.code" => 'required'
        ]);

        Province::create($this->createForm);

        $this->reset('createForm');

        $this->getProvinces();

        //$this->emit('saved');
        $this->dispatch('saved');
    }

    public function edit(Province $province){
        $this->province = $province;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $province->name;
        $this->editForm['code'] = $province->code;
    }

    public function update(){
        $this->province->name = $this->editForm['name'];
        $this->province->code = $this->editForm['code'];
        $this->province->save();

        $this->reset('editForm');
        $this->getProvinces();
    }

    #[On('province-delete')]
    public function provinceDelete(Province $id){
        //dd($id);
        $id->delete();
        $this->getProvinces();
    }

    public function render()
    {
        return view('livewire.admin.provincia-component')->layout('layouts.admin');
    }
}
