@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Megacollection</h3>

        <a href="{{ route('admin.megacollection.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Title</th> 
        <td>{{ $megacollection->title }}</td>
</tr>
    <tr>
        <th>Description</th> 
        <td>{{ $megacollection->description }}</td>
</tr>
    <tr>
        <th>ButtonText</th> 
        <td>{{ $megacollection->buttonText }}</td>
</tr>
    <tr>
        <th>ButtonLink</th> 
        <td>{{ $megacollection->buttonLink }}</td>
</tr>
    <tr>
        <th>ImageUrl</strong></th>
        <td>
            <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
                <img src="{{ Str::startsWith($megacollection->imageUrl, 'http') ? $megacollection->imageUrl : Storage::url($megacollection->imageUrl) }}"
                     alt="Prévisualisation de l'image"
                     style="max-width: 100px; display: block;">
            </div>
        </td>
     </tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.megacollection.edit', ['id' => $megacollection->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection