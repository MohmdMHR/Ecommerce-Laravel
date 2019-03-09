@extends('layouts.app')

@section('content')

    <div class="card">

        <div class="card-header">
            Dashboard
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('product.edit', ['id'=>$product->id]) }}" class="btn btn-xs btn-info">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('product.destroy', ['id'=>$product->id])}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-xs btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{$products->links()}}
            </div>
        </div>
    </div>

@stop











