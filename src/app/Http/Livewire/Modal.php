<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Contact;
use Livewire\WithPagination;

class Modal extends Component
{
    use WithPagination;


    public $showModal = false;

    // protected $paginationTheme = 'bootstrap';

    // public $contact;


    public function render()
    {
        return view('livewire.modal',['contacts'=>Contact::with('category')->paginate(7)]);
    }


    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}