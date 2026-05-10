<h1>Hello Laravel</h1>

<!-- Blade template -->

<h1>{{$name}}</h1> <!-- passing variables with blade template -->

<!-- Same thing in php will be long and bit slower-->

<h1><?php echo $name ?></h1> <!-- with php --> 

<!-- now with functions -->

<h1>{{rand()}}</h1> <!--Passing functions with blade template-->

<!--How to use if else here-->

@if($name=="rishu"){
    <h2>Hey this is rishu</h2>
}
@else{
    <h2>Other user</h2>
}
@endif

<!--For loop here-->

<div>
    @for ($i=0;$i<=10;$i++)
        <h3>Hello Blade</h3>
        <h4>marvel's Blade trinity</h4>
    
        
    @endfor
</div>