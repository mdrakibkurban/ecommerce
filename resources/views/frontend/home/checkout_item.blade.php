<?php
use App\Models\Product;
?>
<div class="container">
    <h3>My Shopping Bag</h3>
    <div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
        <table class="timetable_sub">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Sub Total</th> 
                </tr>
            </thead>
            @php
              $total_price = 0;   
            @endphp
            @foreach ($collection as $cart)
            @php
                $getAttrDiscountPrice = Product::getAttrDiscountPrice($cart->product_id,$cart->size);
            @endphp
            <tr class="rem1">
                <td class="invert-closeb">
                    {{-- <a href="{{ route('remove',$cart->id)}}"> --}}
                        <div class="rem">
                            <div class="close1 deleteCartItem" data-cartId ="{{$cart->id}}"> </div>
                        </div>
                    {{-- </a> --}}
                </td>
                <td class="invert-image">
                    <a href="{{ route('single', ['category' => $cart->product->category->slug ,'slug' =>  $cart->product->slug])}}">
                    <img style="width:50px" src="{{asset("/storage/product_featured_images/".$cart->product->featured_image)}}" alt=" " class="img-responsive" />
                    </a>
                </td>
                <td class="invert">{{$cart->size}}</td>
                <td class="invert">
                     <div class="quantity"> 
                        <div class="quantity-select">                           
                            <div class="entry value-minus updateCartItem" 
                            data-cartid="{{$cart->id}}" data-qty="{{$cart->quantity}}">&nbsp;</div>
                            <div class="entry value"><span>{{ $cart->quantity }}</span></div>
                            <div class="entry value-plus updateCartItem"
                            data-cartid="{{$cart->id}}" data-qty="{{$cart->quantity}}">&nbsp;</div>
                        </div>
                    </div>
                </td>
                <td class="invert">{{$cart->product->name}}</td>
                <td class="invert">
                    Tk. {{ $getAttrDiscountPrice['final_price'] }}
                </td>

                <td class="invert">
                    Tk. {{ $getAttrDiscountPrice['final_price'] * $cart->quantity }}
                </td>

                @php
                    $total_price = $total_price + ($getAttrDiscountPrice['final_price'] * $cart->quantity); 
                @endphp
            </tr>
            @endforeach						
        </table>
    </div>
    <div class="checkout-left">	
            <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                <a href="{{ url('/')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Shopping</a>
            </div>
            <div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
                <h4>Shopping basket</h4>
                <ul>
                    <li style="color: black; font-weight:bolder;font-size:15px;"> Grand Total <i>-</i> <span>Tk .{{ $total_price }}</span></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
</div>

@push('scripts')
<script>
  $( document ).ready(function() {
    $(document).on("click",".updateCartItem",function() {
		if($(this).hasClass('value-plus')){
			let cart_qty  = $(this).attr('data-qty');
		    new_qty = parseInt(cart_qty) + 1;
		}
		if($(this).hasClass('value-minus')){
			let cart_qty  = $(this).attr('data-qty');
			if(cart_qty <=1 ){
				return false;
			}
		    new_qty = parseInt(cart_qty) - 1;
		}

        let cart_id  = $(this).attr('data-cartid');
		
		$.ajax({
			url    : "{{ route('update.qty') }}",
            method : "post",
			data   : {cart_id : cart_id, new_qty : new_qty},
            success: function(result){
                if(result.status == false){
                   alert('Product Stock is Not Available!')
                }
                $(".totalCartItems").html(result.totalCartItems);
			    $(".checkout").html(result.view);
	        },error:function(){
				alert("Error");
			}
       });
    });

     //delete cart Item
    $(document).on("click",".deleteCartItem",function() {
        let cart_id  = $(this).attr('data-cartId');
        let result = confirm('Are you sure to delete this cart item?')
        if(result){
            $.ajax({
			url    : "{{ route('remove') }}",
            method : "post",
			data   : {cart_id : cart_id},
            success: function(result){
                $(".checkout").html(result.view);
	        },error:function(){
				alert("Error");
			}
        });
        }
    });
  });
</script>
@endpush