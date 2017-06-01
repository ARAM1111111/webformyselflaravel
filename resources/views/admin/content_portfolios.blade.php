<div style="margin:0px 50px 0px 50px;">   

@if($portfolios)
 
	<table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Имя</th>
                <th>ФИЛЬТР</th>
                <th>Картинки</th>
                <th>Дата создания</th>               
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
            @foreach($portfolios as $k=>$portfolio)
                <tr>
                    <td>{{$portfolio->id}}</td>
                    <td>{!!Html::link(route('portfolioEdit',['portfolio'=>$portfolio->id]),$portfolio->name,['alt'=>$portfolio->name])!!}</td>
                    <td>{{$portfolio->filter}}</td>
                    <td>{{$portfolio->images}}</td>
                    <td>{{$portfolio->created_at}}</td>
                    <td>
                    {!!Form::open(['url'=>route('portfolioEdit',['portfolio'=>$portfolio->id]),'class'=>'form-horizontal','method'=>'post'])!!}
                        {{-- {!! Form::hidden('_method','delete') !!} --}}
                        {{method_field('DELETE')}}
                        {!! Form::button('DELETE',['class'=>'btn btn-danger','type'=>'submit']) !!}
                    {!! Form::close() !!}
                    </td>
                </tr>
        
		    @endforeach
        </tbody>
    </table>
@endif 

{!! Html::link(route('portfolioAdd'),'Новая страница') !!}
   
</div>