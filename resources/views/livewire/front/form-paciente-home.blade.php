<div class="page pt-5">
  <div class="container">
    <div class="text-center mb-4">
      <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300" /></a>
    </div>
    <div class="text-center mb-4">
      <h1>Complete el siguiente formulario</h1>
    </div>

    <div class="card">
      <div class="card-footer text-end">
        <div class="row">
          <div class="col-sm-6">
            <button class="btn btn-primary float-sm-end" wire:click="$emit('guardar')">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                <circle cx="12" cy="14" r="2"></circle>
                <polyline points="14 4 14 8 8 8 8 4"></polyline>
              </svg>
              Enviar
            </button>

          </div>

        </div>
      </div>
      <div class="card-body">
        <div class="accordion" id="acc-pacientes">
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading-1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1"
                aria-expanded="true">
                Datos Personales
              </button>
            </h2>
            <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#acc-pacientes">
              <div class="accordion-body pt-0">
                <div class="row">

                  <div class="col-md-6 mt-3">
                    <div class="col-md-6">
                      <label class="form-label">Cupón de Descuento</label>
                      <input type="text" class="form-control" wire:model.defer="cod_descto">
                      @error('cod_descto')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">

                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Apellido y Nombre *</label>
                      <input type="text" class="form-control" wire:model.defer="nom_ape" id="nom_ape">
                      @error('nom_ape')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-4 col-md-6">
                      <label class="form-label">DNI *</label>
                      <input type="text" class="form-control" wire:model.defer="dni" id="dni">
                      @error('dni')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Domicilio *</label>
                      <input type="text" class="form-control" wire:model.defer="domicilio">
                      @error('domicilio')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <span class="text-red" style="font-weight: 700">DIRECCION de donde van a estar las plantas, que coincida con REPROCANN (Sin importar la
                      dirección
                      del DNI)</span>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Correo Electrónico *</label>
                      <input type="text" class="form-control" wire:model.defer="email" id="email">
                      @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  
                  
                  <div class="col-md-6 mt-3">
                    <div class="col-12 col-md-8">
                      <label class="form-label">Fecha de Nacimiento *</label>
                      <div class="mb-3">
                        <div class="row">
                          <div class="col-3">
                            <select name="user[day]" class="form-select" wire:model.defer="dia_nac">
                              <option value="">Día</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                            </select>
                          </div>

                          <div class="col-5">
                            <select name="user[month]" class="form-select" wire:model.defer="mes_nac">
                              <option value="">Mes</option>
                              <option value="1">Enero</option>
                              <option value="2">Febrero</option>
                              <option value="3">Marzo</option>
                              <option value="4">Abril</option>
                              <option value="5">Mayo</option>
                              <option value="6">Junio</option>
                              <option value="7">Julio</option>
                              <option value="8">Agosto</option>
                              <option value="9">Septiembre</option>
                              <option value="10">Octubre</option>
                              <option value="11">Noviembre</option>
                              <option value="12">Diciembre</option>
                            </select>
                          </div>

                          <div class="col-4">
                            <select class="form-select" wire:model.defer="anio_nac">
                              <option value="">Año</option>
                              <option value="2014">2022</option>
                              <option value="2014">2021</option>
                              <option value="2014">2020</option>
                              <option value="2014">2019</option>
                              <option value="2014">2018</option>
                              <option value="2014">2017</option>
                              <option value="2014">2016</option>
                              <option value="2014">2015</option>
                              <option value="2014">2014</option>
                              <option value="2013">2013</option>
                              <option value="2012">2012</option>
                              <option value="2011">2011</option>
                              <option value="2010">2010</option>
                              <option value="2009">2009</option>
                              <option value="2008">2008</option>
                              <option value="2007">2007</option>
                              <option value="2006">2006</option>
                              <option value="2005">2005</option>
                              <option value="2004">2004</option>
                              <option value="2003">2003</option>
                              <option value="2002">2002</option>
                              <option value="2001">2001</option>
                              <option value="2000">2000</option>
                              <option value="1999">1999</option>
                              <option value="1998">1998</option>
                              <option value="1997">1997</option>
                              <option value="1996">1996</option>
                              <option value="1995">1995</option>
                              <option value="1994">1994</option>
                              <option value="1993">1993</option>
                              <option value="1992">1992</option>
                              <option value="1991">1991</option>
                              <option value="1990">1990</option>
                              <option value="1989">1989</option>
                              <option value="1988">1988</option>
                              <option value="1987">1987</option>
                              <option value="1986">1986</option>
                              <option value="1985">1985</option>
                              <option value="1984">1984</option>
                              <option value="1983">1983</option>
                              <option value="1982">1982</option>
                              <option value="1981">1981</option>
                              <option value="1980">1980</option>
                              <option value="1979">1979</option>
                              <option value="1978">1978</option>
                              <option value="1977">1977</option>
                              <option value="1976">1976</option>
                              <option value="1975">1975</option>
                              <option value="1974">1974</option>
                              <option value="1973">1973</option>
                              <option value="1972">1972</option>
                              <option value="1971">1971</option>
                              <option value="1970">1970</option>
                              <option value="1969">1969</option>
                              <option value="1968">1968</option>
                              <option value="1967">1967</option>
                              <option value="1966">1966</option>
                              <option value="1965">1965</option>
                              <option value="1964">1964</option>
                              <option value="1963">1963</option>
                              <option value="1962">1962</option>
                              <option value="1961">1961</option>
                              <option value="1960">1960</option>
                              <option value="1959">1959</option>
                              <option value="1958">1958</option>
                              <option value="1957">1957</option>
                              <option value="1956">1956</option>
                              <option value="1955">1955</option>
                              <option value="1954">1954</option>
                              <option value="1953">1953</option>
                              <option value="1952">1952</option>
                              <option value="1951">1951</option>
                              <option value="1950">1950</option>

                            </select>
                          </div>
                        </div>
                      </div>
                      @error('dia_nac')<div class="text-danger">{{ $message }}</div>@enderror
                      @error('mes_nac')<div class="text-danger">{{ $message }}</div>@enderror
                      @error('anio_nac')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div><div class="col-md-6 mt-3">
                    <div class="col-md-8 col-lg-6">
                      <label class="form-label">Código de vinculación del Reprocann</label>
                      <input type="text" class="form-control" wire:model.defer="cod_vincu" id="cod_vincu">
                      @error('cod_vinco')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-3 col-md-4">
                      <label class="form-label">Edad *</label>
                      <input type="text" class="form-control" wire:model.defer="edad">
                      @error('edad')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Localidad *</label>
                      <input type="text" class="form-control" wire:model.defer="localidad">
                      @error('localidad')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Provincia *</label>
                      <select class="form-select" wire:model.defer="idprovincia">
                        <option value="">Seleccione Provincia</option>
                        @foreach($provincias as $pcia)
                        <option value="{{ $pcia->Id }}">{{ $pcia->Provincia }}</option>
                        @endforeach
                      </select>
                      @error('idprovincia')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-3 col-md-4">
                      <label class="form-label">Código Postal *</label>
                      <input type="text" class="form-control" wire:model.defer="cp">
                      @error('cp')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-lg-8 col-md-10">
                      <label class="form-label">Ocupación o Trabajo *</label>
                      <select class="form-select" wire:model.defer="ocupacion" wire:click="refresh()">
                        <option value="">Seleccione una Ocupación</option>
                        @foreach($ocupaciones as $ocup)
                        <option value="{{ $ocup->ocupacion }}">{{ $ocup->ocupacion }}</option>
                        @endforeach
                      </select>
                      @error('ocupacion')<div class="text-danger">{{ $message }}</div>@enderror
                      @if($ocupacion == "Otra")
                      <label class="form-label mt-2 ms-3">Especifique</label>
                      <input type="text" class="form-control ms-3" wire:model.defer="ocupacion_otra">
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-6 col-md-8">
                      <label class="form-label">Celular *</label>
                      <input type="text" class="form-control" wire:model.defer="celular">
                      @error('celular')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <span style="font-weight: 700">ESCRIBA SU NUMERO SIN 0 NI 15. NO SE ADMITEN PUNTOS, COMAS, GUIONES NI ESPACIOS</span>

                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-lg-8 col-md-10">
                      <label class="form-label">Obra Social *</label>
                      <input type="text" class="form-control" wire:model.defer="osocial">
                      @error('osocial')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-12">
                      <label class="form-label">Comentarios sobre su estado de salud que quiera comentar o
                        aclarar</label>
                      <input type="text" class="form-control" wire:model.defer="comentario">
                      @error('comentario')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-10">
                      <label class="form-label">Firma *</label>
                      <div id="firma" style="background: #fff; border:#d9d9d9 solid 1px; margin: 10px 0;"></div>
                      <button class="btn btn-primary ms-auto" wire:click="$emit('limpiarFirma')">Limpiar</button>
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-10">
                      <label class="form-label">Aclaración *</label>
                      <div id="aclaracion" style="background: #fff; border:#d9d9d9 solid 1px; margin: 10px 0;"></div>
                      <button class="btn btn-primary ms-auto" wire:click="$emit('limpiarAclaracion')">Limpiar</button>
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">¿Tiene Arritmias en actividad? *</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="arritmia" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="arritmia" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">¿Tiene antecedentes de algún padecimiento en salud mental? ¿Se encuentra
                        actualmente en tratamiento? *</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="salud_mental" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="salud_mental" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                      @if($salud_mental)
                      <label class="form-label">En caso de Sí, especificar</label>
                      <textarea class="form-control" name="example-textarea-input" rows="3"
                        wire:model.defer="salud_ment_esp"></textarea>
                      @error('salud_ment_esp')<div class="text-danger">{{ $message }}</div>@enderror
                      @endif

                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">
                        ¿Tiene alergia a algún componente de la planta? *</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="alergia" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="alergia" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">

                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">¿Esta embarazada o realizando lactancia? *</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="embarazada" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="embarazada" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">¿Maneja maquinarias de alta precisión? *</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="maneja_maq" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="maneja_maq" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-10">
                      <label class="form-label">Comente con sus palabras enfermedad y/o dolencias que padece que
                        justifiquen
                        el uso de cannabis medicinal *</label>
                      <textarea class="form-control" name="example-textarea-input" rows="6"
                        placeholder="Por ejemplo: Ansiedad - Dolor - Insomnio - Etc"
                        wire:model.defer="patologia"></textarea>
                      @error('patologia')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Cómo nos contactó? *</label>
                      <select class="form-select" wire:model.defer="idcontacto">
                        <option value="">Seleccione Uno</option>
                        @foreach($modos_contacto as $mod)
                        <option value="{{ $mod->idcontacto }}">{{ $mod->modo_contacto }}</option>
                        @endforeach
                      </select>

                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-lg-6 col-md-8">
                      <label class="form-label">Contacto Otro</label>
                      <input type="text" class="form-control" wire:model.defer="contacto_otro">
                      @error('contacto_otro')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">¿Otra persona cultivará para tí?</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="es_menor" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="es_menor" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                    <span style="font-weight: 700">Si la respuesta es Si, ingrese los datos del cultivador o del tutor en la sección de
                      abajo.<br />
                      IMPORTANTE! Ponga los datos de quien recibirá el tratamiento al principio de este formulario y no
                      en
                      la sección del tutor.
                    </span>
                  </div>

                </div>
              </div>
            </div>
          </div>

          @if($es_menor)
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading-2">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2"
                aria-expanded="false">
                Datos del Padre / Madre / Tutor o Encargado
              </button>
            </h2>
            <div id="collapse-2" class="accordion-collapse collapse show" data-bs-parent="#acc-datos-tutor">
              <div class="accordion-body pt-0">
                <div class="row">

                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Apellido y Nombre *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_apeynom">
                      @error('tut_apeynom')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-6">
                      <label class="form-label">Tipo y N° Documento *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_tipo_nro_doc">
                      @error('tut_tipo_nro_doc')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-12 col-md-8">
                      <label class="form-label">Fecha de Nacimiento *</label>
                      <div class="mb-3">
                        <div class="row">
                          <div class="col-3">
                            <select name="user[day]" class="form-select" wire:model.defer="dia_nac_tut">
                              <option value="">Día</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                            </select>
                          </div>

                          <div class="col-5">
                            <select name="user[month]" class="form-select" wire:model.defer="mes_nac_tut">
                              <option value="">Mes</option>
                              <option value="1">Enero</option>
                              <option value="2">Febrero</option>
                              <option value="3">Marzo</option>
                              <option value="4">Abril</option>
                              <option value="5">Mayo</option>
                              <option value="6">Junio</option>
                              <option value="7">Julio</option>
                              <option value="8">Agosto</option>
                              <option value="9">Septiembre</option>
                              <option value="10">Octubre</option>
                              <option value="11">Noviembre</option>
                              <option value="12">Diciembre</option>
                            </select>
                          </div>

                          <div class="col-4">
                            <select class="form-select" wire:model.defer="anio_nac_tut">
                              <option value="">Año</option>
                              <option value="2014">2022</option>
                              <option value="2014">2021</option>
                              <option value="2014">2020</option>
                              <option value="2014">2019</option>
                              <option value="2014">2018</option>
                              <option value="2014">2017</option>
                              <option value="2014">2016</option>
                              <option value="2014">2015</option>
                              <option value="2014">2014</option>
                              <option value="2013">2013</option>
                              <option value="2012">2012</option>
                              <option value="2011">2011</option>
                              <option value="2010">2010</option>
                              <option value="2009">2009</option>
                              <option value="2008">2008</option>
                              <option value="2007">2007</option>
                              <option value="2006">2006</option>
                              <option value="2005">2005</option>
                              <option value="2004">2004</option>
                              <option value="2003">2003</option>
                              <option value="2002">2002</option>
                              <option value="2001">2001</option>
                              <option value="2000">2000</option>
                              <option value="1999">1999</option>
                              <option value="1998">1998</option>
                              <option value="1997">1997</option>
                              <option value="1996">1996</option>
                              <option value="1995">1995</option>
                              <option value="1994">1994</option>
                              <option value="1993">1993</option>
                              <option value="1992">1992</option>
                              <option value="1991">1991</option>
                              <option value="1990">1990</option>
                              <option value="1989">1989</option>
                              <option value="1988">1988</option>
                              <option value="1987">1987</option>
                              <option value="1986">1986</option>
                              <option value="1985">1985</option>
                              <option value="1984">1984</option>
                              <option value="1983">1983</option>
                              <option value="1982">1982</option>
                              <option value="1981">1981</option>
                              <option value="1980">1980</option>
                              <option value="1979">1979</option>
                              <option value="1978">1978</option>
                              <option value="1977">1977</option>
                              <option value="1976">1976</option>
                              <option value="1975">1975</option>
                              <option value="1974">1974</option>
                              <option value="1973">1973</option>
                              <option value="1972">1972</option>
                              <option value="1971">1971</option>
                              <option value="1970">1970</option>
                              <option value="1969">1969</option>
                              <option value="1968">1968</option>
                              <option value="1967">1967</option>
                              <option value="1966">1966</option>
                              <option value="1965">1965</option>
                              <option value="1964">1964</option>
                              <option value="1963">1963</option>
                              <option value="1962">1962</option>
                              <option value="1961">1961</option>
                              <option value="1960">1960</option>
                              <option value="1959">1959</option>
                              <option value="1958">1958</option>
                              <option value="1957">1957</option>
                              <option value="1956">1956</option>
                              <option value="1955">1955</option>
                              <option value="1954">1954</option>
                              <option value="1953">1953</option>
                              <option value="1952">1952</option>
                              <option value="1951">1951</option>
                              <option value="1950">1950</option>

                            </select>
                          </div>
                        </div>
                      </div>
                      @error('dia_nac_tut')<div class="text-danger">{{ $message }}</div>@enderror
                      @error('mes_nac_tut')<div class="text-danger">{{ $message }}</div>@enderror
                      @error('anio_nac_tut')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Domicilio</label>
                      <input type="text" class="form-control" wire:model.defer="tut_domicilio">
                      @error('tut_domicilio')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Localidad *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_localidad">
                      @error('tut_localidad')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Provincia *</label>
                      <select class="form-select" wire:model.defer="tut_idprovincia">
                        @foreach($provincias as $pcia)
                        <option value="{{ $pcia->Id }}">{{ $pcia->Provincia }}</option>
                        @endforeach
                      </select>
                      @error('tut_idprovincia')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-4">
                      <label class="form-label">Código Postal *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_cp">
                      @error('tut_cp')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-8">
                      <label class="form-label">Vínculo con la persona que requiere la inscripción *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_vinculo">
                      @error('tut_vinculo')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-4">
                      <label class="form-label">Teléfono Particular</label>
                      <input type="text" class="form-control" wire:model.defer="tut_tel_part">
                      @error('tut_tel_part')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-4">
                      <label class="form-label">Teléfono Celular *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_tel_cel">
                      @error('tut_tel_cel')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-md-6">
                      <label class="form-label">Correo Electrónico *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_mail">
                      @error('tut_mail')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <div class="col-md-6">
                      <label class="form-label">Obra Social *</label>
                      <input type="text" class="form-control" wire:model.defer="tut_osocial">
                      @error('tut_osocial')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  <div class="col-md-6 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">¿Registro de Familiares?</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="tut_reg_fam" value="1">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="tut_reg_fam" value="0">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          @endif

          <div class="accordion-item">
            <h2 class="accordion-header" id="heading-3">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3"
                aria-expanded="true">
                Patologías
              </button>
            </h2>
            <div id="collapse-3" class="accordion-collapse collapse show" data-bs-parent="#acc-patologias">
              <div class="accordion-body pt-0">
                <div class="row">
                  @if($agregar_patologia)
                  @if($editar_patologia)
                  <h3 class="mt-2">Modificar Patología</h3>
                  @else
                  <h3 class="mt-2">Agregar Patología</h3>
                  @endif
                  <div class="col-md-3 mt-3">
                    <div class="col-md-12">
                      <label class="form-label">Patología</label>
                      <select class="form-select" wire:model.defer="pat_id">
                        <option value=""></option>
                        @foreach($dolencias as $dol)
                        <option value="{{ $dol->iddolencia }}">{{ $dol->dolencia }}</option>
                        @endforeach
                      </select>
                      @error('pat_id')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-2 mt-3">
                    <div class="col-md-10">
                      <label class="form-label">Año Aparición *</label>
                      <input type="text" class="form-control" wire:model.defer="pat_anio">
                      @error('pat_anio')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4 mt-3">
                    <div class="col-md-12">
                      <label class="form-label">¿Qué medicación toma para esto?</label>
                      <textarea class="form-control" name="example-textarea-input" rows="2"
                        wire:model.defer="pat_medicacion"></textarea>
                      @error('pat_medicacion')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-3 mt-3">
                    <div class="col-lg-10 col-md-8">
                      <label class="form-label">Vinculado al Trabajo *</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="pat_probTrabajo" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="pat_probTrabajo" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                  </div>
                  <h3 class="mt-3 fw-bold">Si esto le causa DOLOR, indique:</h3>
                  <div class="col-md-4 mt-2">
                    <div class="col-md-12">
                      <label class="form-label">¿Atenúa el dolor <strong>con la mediación que usa? </strong>*</label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="pat_atenuaDolor" value="1"
                          wire:click="refresh()">
                        <span class="form-check-label">Sí</span>
                      </label>
                      <label class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model.defer="pat_atenuaDolor" value="0"
                          wire:click="refresh()">
                        <span class="form-check-label">No</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-4 mt-2">
                    <div class="col-md-8">
                      <label class="form-label">¿Del 1 al 10 cuánto le duele?</label>
                      <select class="form-select" wire:model.defer="pat_dolorInt">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                      @error('pat_dolorInt')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4 mt-2">
                    <div class="col-md-10">
                      <label class="form-label">Partes de Cuerpo donde le duele</label>
                      <input type="text" class="form-control" wire:model.defer="pat_partesCuerpo">
                      @error('pat_partesCuerpo')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                  </div>

                  

                  @if($editar_patologia)
                  <div class="col my-4">
                    <button class="btn btn-primary" wire:click="actualizarPatologia()">Guardar</button>
                    <button class="btn btn-secondary" wire:click="cancelarAgregarPatologia()">Cancelar</button>
                  </div>
                  @else
                  <div class="col my-4">
                    <button class="btn btn-primary" wire:click="guardarPatologia()">Agregar</button>
                    <button class="btn btn-secondary" wire:click="cancelarAgregarPatologia()">Cancelar</button>
                  </div>
                  @endif

                  @else
                  <div class="col my-4">
                    <button class="btn btn-primary" wire:click="agregarPatologia()">Agregar Patología</button>
                  </div>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Patología</th>
                          <th>Año Aparición</th>
                          <th>¿Qué medicación toma para esto?</th>
                          <th>Vinculado trabajo</th>
                          <th>¿Del 1 al 10 cuánto le duele?</th>
                          <th>Partes del cuerpo donde le duele</th>
                          <th>¿Atenúa Dolor?</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($patologias as $pat)
                        <tr>
                          <td width="120">
                            <button class="btn btn-ghost-light btn-icon" wire:click="quitarPatologia({{$i}})">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="4" y1="7" x2="20" y2="7" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                              </svg>
                            </button>
                            <button class="btn btn-ghost-light btn-icon" wire:click="editarPatologia({{$i}})">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                              </svg>
                            </button>
                          </td>
                          <td>{{ $pat['nombre'] }}</td>
                          <td>{{ $pat['anio'] }}</td>
                          <td>{{ $pat['medicacion'] }}</td>
                          <td>@if($pat['probTrabajo'])Sí @else No @endif</td>
                          <td>{{ $pat['dolorInt'] }}</td>
                          <td>{{ $pat['partesCuerpo'] }}</td>
                          <td>@if($pat['atenuaDolor'])Sí @else No @endif</td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="card-footer text-end">
        <div class="row">
          <div class="col-sm-6">
            <button class="btn btn-primary float-sm-end mt-4" wire:click="$emit('guardar')">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                <circle cx="12" cy="14" r="2"></circle>
                <polyline points="14 4 14 8 8 8 8 4"></polyline>
              </svg>
              Enviar
            </button>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $("#firma").jSignature({syncFormat: 'PNG', height:200})
          $("#aclaracion").jSignature({syncFormat: 'PNG', height:200})
          if("<?php echo $firma ?>" != ""){
            $("#firma").jSignature("importData","<?php echo $firma ?>");
          
          }
          if("<?php echo $aclaracion ?>" != ""){
            $("#aclaracion").jSignature("importData","  <?php echo $aclaracion ?>");    

          }
        });
        
        document.addEventListener('DOMContentLoaded', function () {
              @this.on('resetFirmas', ()  => {
                if("<?php echo $firma ?>" != ""){
                  $("#firma").jSignature("importData","<?php echo $firma ?>");
                
                }
                if("<?php echo $aclaracion ?>" != ""){
                  $("#aclaracion").jSignature("importData","  <?php echo $aclaracion ?>");    

                }
                
              });
          });
          
        document.addEventListener('DOMContentLoaded', function () {
              @this.on('guardar', ()  => {
                //e.preventDefault();
                let firmaData =  $('#firma').jSignature('getData', 'default');
                let aclaracData =  $('#aclaracion').jSignature('getData', 'default');
                @this.call('setFirma',firmaData);
                @this.call('setAclaracion',aclaracData);
                @this.call('update');
                
              });
          });
          document.addEventListener('DOMContentLoaded', function () {
              @this.on('limpiarFirma', ()  => {
                //e.preventDefault();
                $("#firma").jSignature("reset");
              });
          });
          document.addEventListener('DOMContentLoaded', function () {
              @this.on('limpiarAclaracion', ()  => {
                //e.preventDefault();
                $("#aclaracion").jSignature("reset");
              });
          });
</script>



@endpush