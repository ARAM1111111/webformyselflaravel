<div class="wrapper container-fluid">
	{!! Form::open(['url'=>route('serviceAdd'),'class'=>'form-horizontal','method'=>'post']) !!}
	<div class="form-group">
			{!! Form::label('name','Название',['class' => 'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::text('name', old('name'), ['class' => 'form-control','placeholder'=>'Введите название страницы']) !!}
		</div>
	</div>

	<div class="form-group">
			{!! Form::label('icon','значок',['class' => 'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::text('icon', old('icon'), ['class' => 'form-control','placeholder'=>'Введите название Icon']) !!}
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
		 	{!! Form::textarea('text', old('text'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст страницы']) !!}
		 </div>
    </div>

	 <div class="form-group">
	    <div class="col-xs-offset-2 col-xs-10">
	      {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
	    </div>
	  </div>

	{!! Form::close() !!}
</div>
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
	CKEDITOR.replace('editor');
</script>