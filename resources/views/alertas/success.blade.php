@if(session('success'))
    <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡En hora buena!</strong>{{ session('success') }}
    </div>
@endif