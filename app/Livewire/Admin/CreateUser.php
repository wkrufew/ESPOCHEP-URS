<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    
    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        return redirect()->route('admin.edit-asignacion-equipo.edit', $user);
    }
    
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.create-user');
    }
}
