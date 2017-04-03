@foreach($projects as $project)
    @include('projects.display.small', ['project'=>$project])
@endforeach