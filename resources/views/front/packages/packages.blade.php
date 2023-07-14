@extends('layouts.front.package-master')



@section('content')
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title"> Buy Package </h2>
                        <div id="cart"></div>
                        <ol class="breadcrumb">
                            <li><a href="#">Home /</a></li>
                            <li class="current">Buy Package</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="pricing-table" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Packages </h2>
                </div>
                @foreach($category->packages as $package)
                @if($package->available == 'available')
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="table">
                        <div class="icon">
                            <i class="lni-gift"></i>
                        </div>
                        <div class="pricing-header">
                            <p class="price-value"> {{$package->price}} EGP</p>
                        </div>
                        <div class="title">
                            <h3>{{$package->name}}</h3>
                        </div>
                        <ul class="description">
                            <li> Free ad posting up to {{$package->num_of_ads}} ads </li>
                            <li>
                                ad will remain available for a period of {{$package->days}} days
                            </li>
                            <li>
                                this package is valid for {{$package->validity_days}} days
                            </li>

                        </ul>
                        {{-- <form action="{{route('cart.remove',['id'=>$package->id,'category_id'=>$category->id])}}" method="GET">
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                            <input type="hidden" name="package_id" value="{{$package->id}}">
                            <button class="btn btn-common">Add To Cart</button>
                        </form> --}}
                        <input type="checkbox"  
                        onchange="addToCart(event)"
                        data-price="{{$package->price}}" 
                        data-category={{$category->id}} 
                        data-id={{$package->id}} 
                        data-name="{{$package->name}}" >
                        {{-- <button onclick="addToCart(event)" 
                        data-price="{{$package->price}}" 
                        data-category={{$category->id}} 
                        data-id={{$package->id}} 
                        data-name="{{$package->name}}"  
                        class="btn btn-common">Add To Cart</button> --}}
                        
                        {{-- <button 
                         onclick="removeFromCart(event)" style='display: none' 
                         data-category={{$category->id}} 
                         data-id={{$package->id}} 
                         class="btn btn-danger">Remove From Cart</button> --}}
                    </div>
                </div>
                @else
                <div class='col-12 text-center'>
                    No Packages Available Yet For This Category
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </section>
    <a id="cartButton" href="/cart"></a>
@endsection
<script>
window.onload = function () {
    let cartRoute = `<h5> view cart > </h5> `; 
    let total = parseFloat(sessionStorage.getItem("total")) ;
    isNaN(total) || total == 0 ? cartButton.style.display = 'none' : cartButton.style.display = 'flex';
    cartButton.innerHTML = `<h6> Total  ${total} EGP </h6> ${cartRoute}`;
}
    function addToCart(event) {
        let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
        let total = parseFloat(sessionStorage.getItem("total")) || 0 ;
        let id = event.target.dataset.id;
        let category_id = event.target.dataset.category;
        let price = event.target.dataset.price
        let name = event.target.dataset.name
        let cartRoute = `<h5> view cart > </h5> `; 
        let cartButton = document.getElementById('cartButton')
        if(event.target.checked === true){
            let package = {
                id:id,
                name:name,
                category_id:category_id,
                price:price,
                quantity:1,
            }
            let index = cart.findIndex(element => element.id == id && element.category_id == category_id
            );
            if(index != -1){
                cart[index].quantity++;
                sessionStorage.setItem('cart',JSON.stringify(cart));
                total += parseFloat(cart[index].price) * parseInt(cart[index].quantity++);
                sessionStorage.setItem('total',total);
            }
            cart.push(package);
            sessionStorage.setItem('cart',JSON.stringify(cart));
                total += parseFloat(price);
            sessionStorage.setItem('total',total);
            cartButton.style.display = 'flex';
            cartButton.innerHTML = `<h6> Total  ${total} EGP </h6> ${cartRoute}`;
            console.log(total);

        }else if(event.target.checked === false){
            let index = cart.findIndex(element => element.id == id && element.category_id == category_id
            );
            deletedPrice = cart[index].price;
            deletedquantity = cart[index].quantity;
            total -= parseFloat(deletedPrice) * parseInt(cart[index].quantity);
            sessionStorage.setItem('total',total);
            cartButton.innerHTML = `<h6> Total  ${total} EGP </h6> ${cartRoute}`;
            if(total == 0){
                cartButton.style.display = 'none';
            }

            cart.splice(index,1);
            // console.log(total);
            sessionStorage.setItem('cart',JSON.stringify(cart));
        }

    }
</script>
    
