<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;
use App\Models\LinkDirecto;

class LinksDirectos extends Component
{

    public $linksList = [], $showForm = false, $descripcion, $uri, $idSeleccionado;

    protected $rules = [
        'descripcion' => 'required|max:30',
        'uri' => 'required'
    ];


    protected $listeners = ['handleAgregar' => 'handleAgregar', 'copiadoAlPortapapeles','copiadoAlPortapapeles'];

    public function render()
    {
        $this->getLinks();
        return view('livewire.turnero.backend.links-directos');
    }

    public function mount()
    {
        $this->getLinks();
    }

    public function copiadoAlPortapapeles(){
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => "Link copiado al portapapeles"]);
    }

    public function handleForm($accion,$recurso){
        $this->showForm = true;

        if($accion === 'editar'){
            $this->idSeleccionado = $recurso['id'];
            $this->descripcion = $recurso['descripcion'];
            $this->uri = $recurso['uri'];
        }else{
            $this->idSeleccionado = 0;
            $this->descripcion = '';
            $this->uri = '';
        }
    }


    public function handleAgregar(){
        $this->showForm = true;
        $this->idSeleccionado = 0;
        $this->descripcion = '';
        $this->uri = '';
    }


    public function editarUrl(){
        $this->validate();
        $link = LinkDirecto::find($this->idSeleccionado);

        $link->update([
            'descripcion' => $this->descripcion,
            'uri' => $this->uri,
        ]);

        $this->showForm = false;
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => "URL editada correctamente"]);
    }


    public function eliminarUrl($id){
        LinkDirecto::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => "URL eliminada"]);
    }


    public function agregarUrl(){
        $this->validate();
        $prefijos = array('doconlineargentina.com/turnero/', 'https://doconlineargentina.com/turnero/');

        foreach ($prefijos as $prefijo) {
            if (strpos($this->uri, $prefijo) === 0) {
                $this->uri = substr($this->uri, strlen($prefijo));
                break;
            }
        }

        LinkDirecto::create([
            'descripcion' => $this->descripcion,
            'uri' => $this->uri
        ]);

        $this->showForm = false;
    }


    public function submit(){
        if($this->idSeleccionado !== 0){
            $this->editarUrl();
        }else{
            $this->agregarUrl();
        };
    }


    public function hiddenForm(){
        $this->resetValidation();
        $this->showForm = false;
    }


    public function copiarAlPortapapeles($link)
    {
        $this->emit('copiarTexto', $link);
    }


    public function getLinks(){
        $this->linksList = LinkDirecto::get();
    }
}
