$(document).ready(function(){

	showTable();
	
	$('.SaleBtn').on('click', function(){
		alert('allert')
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
		});

	function showTable(){
		var sale = localStorage.getItem('sale');

		if (sale) {
			$('.mySaleList').show();
			$('.nosalelist').hide();

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

					var price = perprice;
					var subtotal = price * quantity;
					var str_subtotal = CommaFormatted(subtotal.toString());


					salecartData += `<tr> 
					<td>
					<img src="${photo}" alt="" class="img-fluid" style="width:50px; height:50px; object-fit:cover">
					<h6> ${name} </h6>
					</td>`;
					salecartData += `<td>
					${str_perprice} Ks
					</td>`;
					
					salecartData += `<td>
					<a class="btn dec qtybtn" data-id="${i}">-</a>
					${quantity}
					<a class="btn inc qtybtn" data-id="${i}">+</a> 
					</td>
					<td>
					${str_subtotal} Ks
					</td>
					
					<td>
					<span class="icon_close remove_btn" data-id="${i}"></span>
					</td>
					</tr>`;
					total += subtotal ++;
				});
				var totality = total;
				// console.log(total);
				console.log(totality);

				$('#salTable').html(salecartData);
				$('.totality').html(CommaFormatted(totality.toString())+' Ks');


			}
			else{
				$('.mySaleList').hide();
				$('.nosalelist').show();
			}
		}
		else{
			$('.mySaleList').hide();
			$('.nosalelist').show();
		}
	}

	// Remove Item
	$('#salTable').on('click','.remove_btn', function()
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

	});

	// Add Quantity
	$('#salTable').on('click','.inc', function()
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

	});

	// Sub Quantity
	$('#salTable').on('click','.dec', function()
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