$(document).ready(function(){

	cartNoti();
	showTable();
	

	$('.addSaleBtn').on('click', function(){
		var id = $(this).data('id');
		var name = $(this).data('name');
		var codeno = $(this).data('codeno');
		var photo = $(this).data('photo');
		var perprice = $(this).data('perprice');
		var quantity = 1;

		var mylist = {id:id, codeno:codeno,
					name:name, photo:photo,
					perprice:perprice,quantity:quantity};

		console.log(mylist);

		var sale = localStorage.getItem('sale');
		var saleArray;

		if (sale==null) {
			saleArray = Array();
		}
		else{
			saleArray = JSON.parse(sale);
		}

		var status=false;

		$.each(saleArray, function(i,v){
			if (id == v.id) {
				v.quantity++;
				status = true;
			}
		});

		if (!status) {
			saleArray.push(mylist);
		}

		var saleData = JSON.stringify(saleArray);
		localStorage.setItem("sale",saleData);

		cartNoti();
	});

	function cartNoti(){
		var sale = localStorage.getItem('sale');
		if (sale) {
			var saleArray = JSON.parse(sale);
			var total =0;
			var noti = 0;
			$.each(saleArray, function(i,v){

				var perprice = v.perprice;
				var quantity = v.quantity;
				
				var total = perprice * quantity;

				noti += quantity ++;
			})
			$('.shoppingcartNoti').html(noti);
			$('.salecartTotal').html(CommaFormatted(total.toString())+' Ks');
		}
		else{
			$('.shoppingcartNoti').html(0);
			$('.salecartTotal').html(0+' Ks');
		}
	}

	function showTable(){
		var sale = localStorage.getItem('sale');

		if (sale) {
			$('.salecart_div').show();
			$('.nosalecart_div').hide();

			var saleArray = JSON.parse(sale);
			var salecartData='';


			if (saleArray.length > 0) {
				var total = 0;
				$.each(saleArray, function(i,v){
					var id = v.id;
					var codeno = v.codeno;
					var name = v.name;
					var perprice = v.perprice;
					var photo = v.photo;
					var quantity = v.quantity;
					
					var str_perprice = CommaFormatted(perprice.toString());
					console.log(str_perprice);

					var subtotal = perprice * quantity;
                    var str_subtotal = CommaFormatted(subtotal.toString());


					salecartData += `<tr> 
											<td class="sale__cart__item">
		                                        <img src="${photo}" alt="" class="img-fluid" style="width:120px; height:100px; object-fit:cover">
		                                        <h5> ${name} </h5>
		                                    </td>`;
						salecartData += `<td class="sale__cart__price">
		                                        ${str_perprice} Ks
		                                    </td>`;
					
						salecartData += `<td class="sale__cart__quantity">
		                                        <div class="quantity">
		                                            <div class="pro-qty">
		                                            	<a class="btn dec qtybtn" data-id="${i}">-</a>
		                                                ${quantity}
		                                                <a class="btn inc qtybtn" data-id="${i}">+</a>
		                                            </div>
		                                        </div>
		                                    </td>
											<td class="sale__cart__total">
		                                        ${str_subtotal} Ks
		                                    </td>
											
		                                    <td class="sale__cart__item__close">
		                                        <span class="icon_close remove_btn" data-id="${i}"></span>
		                                    </td>
		                                </tr>`;
					total += subtotal ++;
				});
				var totality = total;
				// console.log(total);
				console.log(totality);

				$('tbody').html(salecartData);
				$('.totality').html(CommaFormatted(totality.toString())+' Ks');


			}
			else{
				$('.salecart_div').hide();
				$('.nosalecart_div').show();
			}
		}
		else{
			$('.salecart_div').hide();
			$('.nosalecart_div').show();
		}
	}

	// Remove Item
	$('tbody').on('click','.remove_btn', function()
	{
		var id = $(this).data('id');

		console.log(id);

		var sale=localStorage.getItem("sale");
		var saleArray = JSON.parse(sale);

		$.each(saleArray,function (i,v) 
		{
			if (i == id) 
			{
				saleArray.splice(id,1);
			}
		})

		var saleData=JSON.stringify(saleArray);

		localStorage.setItem("sale",saleData);
		
		showTable();
		cartNoti();

	});

	// Add Quantity
	$('tbody').on('click','.inc', function()
	{
		var id = $(this).data('id');

		var sale=localStorage.getItem("sale");
		var saleArray = JSON.parse(sale);
		
		$.each(saleArray,function (i,v) 
		{
			console.log(i);
			if (i == id) 
			{
				v.quantity++;
			}
		})
		
		var saleData = JSON.stringify(saleArray);
		localStorage.setItem('sale',saleData);
		showTable();
		cartNoti();

	});

	// Sub Quantity
	$('tbody').on('click','.dec', function()
	{
		var id = $(this).data('id');

		var sale=localStorage.getItem("sale");
		var saleArray = JSON.parse(sale);
		
		$.each(saleArray,function (i,v) 
		{
			if (i == id) 
			{
				v.quantity--;
				if (v.quantity == 0) 
				{
					saleArray.splice(id,1);
				}
			}
		})
		
		var saleData = JSON.stringify(saleArray);
		localStorage.setItem('sale',saleData);
		showTable();
		cartNoti();

	});

	$('.checkoutBtn').click(function () {

		alert(error);
	    var cart=localStorage.getItem("cart"); //string
	    var note = $('#notes').val();  //get note from input

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.post('/order',{
			data:cart,note:note 
		},function(response){
			alert('HEllo');
			//localStorage.clear();
			location.href="ordersuccess";
		});
	});

	function CommaFormatted(amount) 
    {
        var delimiter = ","; // replace comma if desired
        var a = amount.split('.',2)
        var i = parseInt(a[0]);
        
        if(isNaN(i)) 
        {
            return ''; 
        }
        
        var minus = '';
        
        if(i < 0) 
        {
            minus = '-'; 
        }
        
        i = Math.abs(i);
        var n = new String(i);

        var a = [];
        
        while(n.length > 3) {
            var nn = n.substr(n.length-3);
            a.unshift(nn);
            n = n.substr(0,n.length-3);
        }

        if(n.length > 0) 
        { 
            a.unshift(n); 
        }
        n = a.join(delimiter);

        amount = minus + amount;

        // console.log(n);

        return n;

    }

});