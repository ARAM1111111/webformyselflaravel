<div class="wrapper container-fluid">
{!! Form::open(['url' => route('serviceEdit',array('portfolio'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
    	{!! Form::hidden('id', $data['id']) !!}
	     {!! Form::label('name', 'Название:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('name', $data['name'], ['class' => 'form-control','placeholder'=>'Введите название страницы']) !!}
		 </div>
    </div>
    
    <div class="form-group">
	     {!! Form::label('icon', 'Псевдоним:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('icon',  $data['icon'], ['class' => 'form-control','placeholder'=>'Введите псевдоним страницы']) !!}
		 </div>
		 <div class="col-xs-8">
			<div class="service_block" style="margin-bottom: 20px">
				{{-- <span class="service_icon"><i class="fa"></i></span> --}}	
			</div>
		</div>
    </div>
    
    <div class="form-group">
	     {!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::textarea('text', $data['text'], ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст страницы']) !!}
		 </div>
    </div>
    
      <div class="form-group">
	    <div class="col-xs-offset-2 col-xs-10">
	      {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
	    </div>
	  </div>
    
{!! Form::close() !!}

 <script>
 $(document).ready(function() {

		 $('#icon').focusout(function(event) {
			var icon = $(this).val();
			// $('i').addClass(icon);
			$('.service_block').html("<span class='service_icon'><i class='fa "+icon+"'></i></span>")
			// console.log(icon);
		});

		 $('#icon').focusin(function(event) {
			var icon = $(this).val();
			$('.service_block').html('');
			// $('i').removeClass(icon);
			// console.log(icon);
		});

	});
	CKEDITOR.replace( 'editor' );
</script>
</div>