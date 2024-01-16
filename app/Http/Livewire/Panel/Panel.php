<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;
use App\Models\Link;

class Panel extends Component
{
    public $urlList, $idSeleccionado, $url, $nombre, $showForm, $editar = false, $image, $destacadosCount;

    protected $rules = [
        'nombre' => 'required|max:30',
        'url' => 'required',
        'image' => ''
        ];

    public function render(){
        $this->getUrls();
        $this->contarDestacados();
        return view('livewire.panel.panel');
    }

    public function contarDestacados(){
       $destacados = 0;

       foreach($this->urlList as $url){
            if($url['destacado'] === 1){
                $destacados = $destacados + 1;
            }
       }

       $this->destacadosCount = $destacados;
    }

    public function getUrls(){
        $this->urlList = Link::get();
        $this->urlList;
    }

    public function editarUrl(){
        $this->validate();
        $link = Link::find($this->idSeleccionado);
        if(!$this->image || $this->image === ''){
            $this->image = $this->getFavicon($this->url);
        }

        $link->update([
            'url' => $this->url,
            'destacado' => $this->destacado,
            'image' => $this->image,
            'nombre' => $this->nombre
        ]);

        $this->showForm = false;
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => "URL editada correctamente"]);
    }


    public function eliminarUrl($id){
        Link::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => "URL eliminada"]);
    }


    public function agregarUrl(){
        $this->validate();
        if(!$this->image || $this->image === ''){
            $this->image = $this->getFavicon($this->url);
        }

        if (strpos($this->url, "https://") !== 0) {
            $this->url = "https://" . $this->url;
        }

        Link::create([
            'url' => $this->url,
            'destacado' => $this->destacado,
            'image' => $this->image,
            'nombre' => $this->nombre
        ]);

        $this->showForm = false;

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "URL agregada correctamente"]);
    }

    function getFavicon($url) {

       try {

            if (strpos($url, 'spreadsheet') !== false) {
                return 'https://cdn-icons-png.flaticon.com/256/2965/2965327.png';
            }

            if (strpos($url, 'drive.google.com') !== false) {
                return 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/Google_Drive_icon_%282020%29.svg/1147px-Google_Drive_icon_%282020%29.svg.png';
            }

            if (strpos($url, 'www.google.com') !== false) {
                return 'https://www.google.com/favicon.ico';
            }

            if (!preg_match('/^https?:\/\//i', $url)) {
                $url = 'http://' . $url;
            }

            if (strpos($url, 'doconlineargentina.com') !== false) {
                return 'http://doconlineargentina.com/turnero/assets/favicon-2345e915.png';
            }

            if(filter_var($url, FILTER_VALIDATE_URL) !== false){
                $html = @file_get_contents($url);
            }else{
                return null;
            };

            if($html === false){
                return null;
            }


            preg_match('/<link[^>]*rel=["\']icon["\'][^>]*href=["\']([^"\']+)/i', $html, $matches);

            if (empty($matches[1])) {
                preg_match('/<link[^>]*rel=["\']apple-touch-icon["\'][^>]*href=["\']([^"\']+)/i', $html, $matches);
            }

            if (!empty($matches[1])) {
                if (strpos($matches[1], 'http') !== 0) {
                    $base_url = rtrim($url, '/');
                    $matches[1] = $base_url . '/' . ltrim($matches[1], '/');
                }
                return $matches[1];
            }
        } catch (Exception $e) {
            error_log('Error en getFavicon: ' . $e->getMessage());
        }

        return null;
    }



    public function submit(){
        if($this->idSeleccionado !== 0){
            $this->editarUrl();
        }else{
            $this->agregarUrl();
        }
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debes completar este campo.',
            'nombre.max' => 'El campo nombre debe tener menos de :max caracteres.',
            'url.required' => 'Debes completar este campo.',
        ];
    }


    public function handleForm($accion,$recurso){
        $this->showForm = true;

        if($accion === 'editar'){
            $this->idSeleccionado = $recurso['id'];
            $this->nombre = $recurso['nombre'];
            $this->destacado = $recurso['destacado'];
            $this->url = $recurso['url'];
            $this->image = $recurso['image'];
        }else{
            $this->idSeleccionado = 0;
            $this->nombre = '';
            $this->url = '';
            $this->destacado = false;
            $this->image = '';
        }
    }

    public function hiddenForm(){
        $this->resetValidation();
        $this->showForm = false;
    }

    public function switchEditar(){
        $this->editar = !$this->editar;
    }
}
