{!! Form::open(['route' => ['base.machines.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('base.machines.machineCapacities.index', $id) }}" class='btn btn-ghost-success'>
       <i class="fa fa-book"></i>
    </a>
    <a href="{{ route('base.machines.edit', $id) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
