@extends('layouts.master')

	@section('title', 'Inicio')


	@section('index')
		class="active"
	@endsection
	@section('content')
	<section class="contenido">
		
 		<div id="slider" class="img-responsive"> 
			<img src="/img/slide-4.jpg" class="img-responsive">
			<img src="/img/slide-3.jpg" class="img-responsive">
			<img src="/img/slide-2.jpg" class="img-responsive">
			<img src="/img/slide-1.jpg" class="img-responsive">

		</div>

		<style type="text/css">
			#slider{
    			position: relative; 
    			width: 70%; 
    			height: auto; 
    			padding: 10px; 
    			margin-top: 20px;
    			margin-left: auto;
    			margin-right: auto;
			    box-shadow: 0 0 10px rgba(0,0,0,0.4); 
			    text-align: center;
			}
			#slider img{
				display: none;
    			width: 100%;
    			height: auto;

			}
			#slider img:nth-child(1){
				display: block;
			}
		</style>

		<script type="text/javascript">
			var i = 0;
			$(document).on("ready", main);

			function main(){
				var control = setInterval(cambiarSlider, 4000);
			}

			function cambiarSlider(){
				i++;
				if(i == $("#slider img").size()){
				i = 0;
				}
			$("#slider img").hide();
			$("#slider img").eq(i).fadeIn("medium");
			}
		</script>

	</section> 
	@endsection
