<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3333">
    <div class="carousel-indicators">
        @foreach ($sliders as $key=>$slider)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" 
                aria-label="Slide {{$key+1}}" 
                class="@if($key==0) active @endif" 
                aria-current="@if($key==0) true @endif">
            </button>
        @endforeach
    </div>
    <div class=" container carousel-inner mt-3">
        @foreach ($sliders as $key=>$slider)
        <div class="carousel-item @if($key==0) active @endif data-bs">
            <img src="{{'storage/'.$slider->image}}" class="d-block w-100" alt="...";>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>