$(document).ready(function(){
	getData();


	// Add To SaleCart
	$(".SaleBtn").on('click',function(e){

		var qty=parseInt($('#qty').val());
		var id = $(this).data('id');
		var name = $(this).data('name');
		var photo = $(this).data('photo');
		var perprice = $(this).data('perprice');
		alert('id => '+id);
		var qty=1;
		if (qty) {
			qty+=qty;

		}

		var sale_item = {
			id:id,
			name:name,
			perprice:perprice,
			photo:photo,
			qty:qty
		}

		var saleString = localStorage.getItem("Mysale");
		var saleArray;
		if (saleString==null) {
			saleArray=Array();
		}else {
			saleArray=JSON.parse(saleString);
		}

		var status = false;
		$.each(saleArray,function(i,v){
			if (id==v.id) {
				status = true;
				if (!qty) {
					v.qty++;
				}else{
					v.qty+=qty;
				}
			}
		})

		if (status==false) {
			saleArray.push(sale_item);

		}

		var saleData = JSON.stringify(saleArray);
		localStorage.setItem("Mysale", saleData);



		//count();

	});

	// Show to Table Data
	function getData(){
		var saleString = localStorage.getItem("Mysale");
		if (saleString) {
			var saleArray = JSON.parse(saleString);

			var html='';
			var no=1;
			var total=0;
			$.each(saleArray,function(i,v){
				var name = v.name;
				var perprice = v.price;
				var qty = v.qty;
			
					var price_show = perprice;
					var price = perprice;
				

				html += `<tr>
						<td>${no++}</td>
						<td>${name}</td>
						<td>${price_show}</td>
						<td><button class="btn btn-light btn-sm min" data-item_i="${i}">-</button> ${qty} <button class="btn btn-light btn-sm max" data-item_i="${i}">+</button></td>
						<td>${price*qty}</td>

					</tr>`;	

					total += price*qty;
			});

			html+=`<tr>
				<td colspan="4">Total</td>
				<td>${total}</td>
				</tr>`

			$("#salTable").html(html);
			$(".total").val(total);

		}else{
			html='';
			$("#salTable").html(html);
		}

	}



	$("#salTable").on('click','.max',function(){

		var item_i = $(this).data('item_i');

		var saleString = localStorage.getItem("Mysale");
		if (saleString) {

			var saleArray = JSON.parse(saleString);

			$.each(saleArray,function(i,v){
				if (item_i==i) {
					v.qty++;
				}

			})

			var saleData=JSON.stringify(saleArray);
			localStorage.setItem("Mysale",saleData);
			getData();
			count();

		}

	});

	$("#salTable").on('click','.min',function(){
		var item_i = $(this).data('item_i');

		var saleString = localStorage.getItem("Mysale");
		if (saleString) {

			var saleArray = JSON.parse(saleString);

			$.each(saleArray,function(i,v){
				if (item_i==i) {
					v.qty--;
					if (v.qty==0) {
						saleArray.splice(item_i,1);
					}
				}

			})

			var saleData=JSON.stringify(saleArray);
			localStorage.setItem("Mysale",saleData);
			getData();
			count();

		}

	})


})