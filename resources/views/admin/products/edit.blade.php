@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Productos</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-md-12">
                                <form method="post" action="/productos/store" enctype="multipart/form-data">
                                    @csrf
                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col">
                                      <div class="form-outline">
                                        <label class="form-label" for="image"
                                          >SELECIONE UNA IMAGEN</label
                                        >
                                        <input type="file" id="image" name="image" class="form-control"  value={{$productos->image}}/>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-outline">
                                        <label class="form-label" for="title">Nombre</label>
                                        <input type="text" id="title" class="form-control"  name="title"  value={{$productos->title}}/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                    <div class="col">
                                      <!-- Text input -->
                                      <div class="form-outline">
                                        <label class="form-label" for="price">Precio</label>
                                        <input
                                          type="number"
                                          step="0.01"
                                          id="price"
                                          name="price"
                                          class="form-control"
                                          value={{$productos->price}}
                                        />
                                      </div>
                                    </div>
                                    <div class="col">
                                      <!-- Text input -->
                                      <div class="form-outline">
                                        <label class="form-label" for="stock">Cantidad</label>
                                        <input
                                          type="number"
                                          min="0"
                                          id="stock"
                                          name="stock"
                                          class="form-control"
                                          value={{$productos->stock}}
                                        />
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Checkbox -->
                                  <div class="form-check d-flex mb-4">
                                    <input
                                      class="form-check-input me-2"
                                      type="checkbox"
                                      value="1"
                                      id="status"
                                      name="status"
                                      checked
                                    />
                                    <label class="form-check-label" for="status"> Activo? </label>
                                  </div>

                                  <!-- Message input -->
                                  <div class="form-outline mb-4">
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                    <label class="form-label" for="description">Descrpciòn</label>
                                  </div>

                                  <!-- Submit button -->
                                  <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Crear
                                  </button>
                                </form>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

