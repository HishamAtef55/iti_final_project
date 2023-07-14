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
                            <li><a href="#">Profile /</a></li>
                            <li class="current">Buy Package</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="pricing-table" class="section-padding">
        <div class="container">
            <form action="/orders" method="POST">
                <input type="hidden" name="total" value="" id="total">
                @csrf
                <div class="row" id="packagesCart">
                    <div class="col-12">
                    <h2 class="section-title">Packages </h2>
                    </div>
                </div>
                <button onclick="deleteCart()" id="paytButton" class="price-value" value="submit"></button>
            </form>
        </div>
    </section>
@endsection
<script>
    window.onload = function () {
        let total = parseFloat(sessionStorage.getItem("total")) ;
        let inputTotal = document.getElementById('total');
        let cartData = sessionStorage.getItem("cart");

        inputTotal.value = total;

        isNaN(total) || total == 0 ? paytButton.style.display = 'none' : paytButton.style.display = 'flex';
        paytButton.innerHTML = `<h6> Pay  ${total} EGP </h6>`;

        function getCartSession() {
            let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
            cart.forEach(ele => createPackages(ele))
        }

        function createPackages(element) {
            // let packageprice = parseFloat(price);
            packagesCart.innerHTML +=
                `<div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="table">
                        <div class="icon">
                            <i class="lni-gift"></i>
                        </div>
                        <div class="pricing-header">
                            <p class="price-value">Price : ${element.price} EGP </p>
                        </div>
                        <input type="hidden" name="ids[]" value="${element.id}">
                        <input type="hidden" name="category_ids[]" value="${element.category_id}">

                        <div class="title">
                            <h3>Package Name : ${element.name} </h3>
                        </div>
                        <input type="hidden" name="quantities[]" value="${element.quantity}">
                        <div id="quantityDiv" class="title">
                            <button
                                class="btn btn-number"
                                id="decermentButton"
                                data-price="${element.price}"
                                data-category=${element.category_id}
                                data-id=${element.id}
                                onclick="decrease()"> -
                            </button>
                            <p id="quantityParagraph"> ${element.quantity} </p>
                            <button
                                class="btn btn-number"
                                id="incermentButton"
                                data-price="${element.price}"
                                data-category=${element.category_id}
                                data-id=${element.id}
                                onclick="increase()"> +
                            </button>
                        </div>
                        <div class="pricing-header">
                            <p class="price-value">${parseFloat(element.price)*parseFloat(element.quantity)} EGP </p>
                        </div>
                    </div>
                </div>`
        }
        getCartSession()
    }
    function increase() {
        event.preventDefault();
        let inputTotal = document.getElementById('total');
        let packageToatal = event.target.parentNode.nextElementSibling.firstElementChild;
        let id = event.target.dataset.id;
        let category_id = event.target.dataset.category;
        let price = event.target.dataset.price;
        let cart = JSON.parse(sessionStorage.getItem("cart")) ;
        let total = parseFloat(sessionStorage.getItem("total"));
        let index = cart.findIndex(element => element.id == id && element.category_id == category_id);
        cart[index].quantity++;
        sessionStorage.setItem('cart',JSON.stringify(cart));
        // console.log(cart[index].quantity++);
        let currentQuantity = parseInt(event.target.previousElementSibling.innerHTML);
        currentQuantity++
        event.target.previousElementSibling.innerHTML = currentQuantity;
        let quantityInput = event.target.parentNode.previousElementSibling.value
        quantityInput++
        event.target.parentNode.previousElementSibling.value = quantityInput;
        event.target.previousElementSibling.previousElementSibling.disabled = false
        packageToatal.innerHTML = `${parseFloat(price)*currentQuantity} EGP`
        total += parseFloat(price);
        sessionStorage.setItem('total',total);
        paytButton.style.display = 'flex';
        paytButton.innerHTML = `<h6> Pay  ${total} EGP </h6>`;
        inputTotal.value = total;
    }
    function decrease() {
        event.preventDefault();
        let inputTotal = document.getElementById('total');
        let packageToatal = event.target.parentNode.nextElementSibling.firstElementChild;
        let id = event.target.dataset.id;
        let category_id = event.target.dataset.category;
        let price = event.target.dataset.price;
        let cart = JSON.parse(sessionStorage.getItem("cart")) ;
        let total = parseFloat(sessionStorage.getItem("total"));
        let index = cart.findIndex(element => element.id == id && element.category_id == category_id);
        if(cart[index].quantity > 1 && parseInt(event.target.nextElementSibling.innerText) > 1)
        {
            event.target.disabled = false;
            cart[index].quantity--
            sessionStorage.setItem('cart',JSON.stringify(cart));
            let currentQuantity = parseInt(event.target.nextElementSibling.innerHTML);
            currentQuantity--
            event.target.nextElementSibling.innerHTML = currentQuantity;
            let quantityInput = event.target.parentNode.previousElementSibling.value
            quantityInput--
            event.target.parentNode.previousElementSibling.value = quantityInput;            packageToatal.innerHTML = `${parseFloat(price)*currentQuantity} $`
            total -= parseFloat(price);
            sessionStorage.setItem('total',total);
            inputTotal.value = total;
            paytButton.style.display = 'flex';
            paytButton.innerHTML = `<h6> Pay  ${total} EGP </h6>`;
        }
        else if(event.target.nextElementSibling.innerText = 1){
            event.target.disabled = true;
        }

    }
    function deleteCart() {
        sessionStorage.removeItem('total');
        sessionStorage.removeItem('cart')
    }
</script>

