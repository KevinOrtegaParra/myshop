@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{route('category.update',['category' => $category->id])}}">
        @method('PATCH')
        @csrf

        <div class="mb-3 col">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

         @error('color')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

            <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría</label>
            <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1" placeholder="Hogar" value="{{ $category->name }}">
            
            <label for="exampleColorInput" class="form-label">Escoge un color para la categoría</label>
            <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="{{ $category->color }}" title="Choose your color">

            <input type="submit" value="Actualizar tarea" class="btn btn-primary my-2" />
        </div>
    </form>

    <div >
    @if ($category->posts->count() > 0)
        @foreach ($category->posts as $post )
            <div class="row py-2 border-top">
                <div class="col-md-4 mb-2">
                    <a href="{{ route('posts-edit', ['id' => $post->id]) }}">{{ $post->title }}</a>
                </div>

                <div class="col-md-8 d-flex justify-content-between align-items-center">
                    <form action="{{ route('posts-destroy', [$post->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$post->id}}">Descripción</button>
                </div>
            </div>


            
             <!-- Modal -->
             <div class="modal fade" id="modal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Descripción de la Tarea</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ $post->description }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>


        @endforeach    
    @else
        No hay tareas para esta categoría
    @endif
    
    </div>
    </div>
</div>
@endsection