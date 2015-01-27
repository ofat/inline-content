@extends($layout)

@section('title')
Content
@stop

@section($contentSection)
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <a href="{{ route('content.admin.index') }}" class="btn btn-info">List</a>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group text-right">
            <a href="{{ route('content.admin.create') }}" class="btn btn-primary">Add new entity</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Slug</th>
                </tr>
            </thead>
            <tbody>
                @foreach($models as $model)
                <tr>
                    <td>{{ $model->id }}</td>
                    <td>
                        {{ $model->translation->slug }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop