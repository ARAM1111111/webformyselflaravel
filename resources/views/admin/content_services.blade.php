<div style="margin:0px 50px 0px 50px;">   


 @if($services)
	<table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Имя</th>            
                <th>Текст</th>
                <th>значок</th>
                <th>Дата создания</th>               
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $k=>$service)
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{!! Html::link(route('serviceEdit',['service'=>$service->id]), $service->name,['alt'=>$service->name]) !!}</td>
                    <td>{{$service->text}}</td>
                    <td>{{$service->icon}}</td>
                    <td>{{$service->creathed_at}}</td>
                    <td>
                        {!! Form::open(['url'=>route('serviceEdit',['service'=>$service->id]),'class'=>'form-horizontal','method'=>'post']) !!}
                        {{method_field('delete')}}
                        {!! Form::submit('DELETE', ['class'=>'btn btn-danger']) !!}
                                
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
		    
        </tbody>
    </table>
    {!! Html::link(route('serviceAdd'), 'Новая страница') !!}
@endif

   
</div>