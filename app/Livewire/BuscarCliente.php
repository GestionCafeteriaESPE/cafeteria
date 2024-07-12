<?php

namespace App\Livewire;
use App\Models\Cliente;

use Livewire\Component;

class BuscarCliente extends Component
{
    //protected $listeners = ['updatedCedulaCli'];
    
    public $cedula_cli;
    public $nombre_cli;
    public $telefono_cli;
    public $email_cli;
    public $is_cliente_found = false;

    public function verificarCedula()
    {
        $cliente = Cliente::where('cedula_cli', $this->cedula_cli)->first();

        if ($cliente) {
            $this->nombre_cli = $cliente->nombre_cli;
            $this->telefono_cli = $cliente->telefono_cli;
            $this->email_cli = $cliente->email_cli;
            $this->is_cliente_found = true;
        } else {
            $this->nombre_cli = '';
            $this->telefono_cli = '';
            $this->email_cli = '';
            $this->is_cliente_found = false;
        }
    }

    public function render()
    {
        return view('livewire.buscar-cliente')
        ->extends('layouts.app')
        ->section('content');
    }
}
