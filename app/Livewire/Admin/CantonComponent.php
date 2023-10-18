<?php

namespace App\Livewire\Admin;

use App\Models\Canton;
use App\Models\Parish;
use Livewire\Component;
use Livewire\Attributes\On; 

class CantonComponent extends Component
{
    public $canton, $parishes, $parish;

    public $createForm = [
        'name' => '',
        'code' => '',
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        'code' => '',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'name',
        'createForm.code' => 'code',
    ];

    public function mount(Canton $canton){
        $this->canton = $canton;
        $this->getParishes();
    }

    public function getParishes(){
        $this->parishes = Parish::where('canton_id', $this->canton->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required',
            "createForm.code" => 'required',
        ]);

        $this->canton->parishes()->create($this->createForm);

        $this->reset('createForm');

        $this->getParishes();

        $this->dispatch('saved');
    }

    public function edit(Parish $parish){
        $this->parish = $parish;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $parish->name;
        $this->editForm['code'] = $parish->code;
    }

    public function update(){
        $this->parish->name = $this->editForm['name'];
        $this->parish->code = $this->editForm['code'];
        $this->parish->save();

        $this->reset('editForm');
        $this->getParishes();
    }

    #[On('parish-delete')]
    public function delete(Parish $parish){
        $parish->delete();
        $this->getParishes();
    }
    public function render()
    {
        return view('livewire.admin.canton-component')->layout('layouts.admin');
    }
}
