function buyCoin(){
	$('#error').hide();

	$.ajax({
	    type : 'POST',
	    url :'/coin/buy',
	    data:{
	    	amount: (Math.random() * (10 - 1) + 1).toFixed(2)
	    },
	    dataType: 'json',
	    success: function(data){
	    	$('#coin-hash').val(data.hash);
	    	$('#coin-amount').html(data.balance);

		 }

	});


}

function validate(){
	$('#error').hide();

	$.ajax({
	    type : 'POST',
	    url :'/coin/validate',
	    data: {
	    	hash: $('#coin-hash').val()

	    },
	    dataType: 'json',
	    success: function(data){
	    	$('#verify-amount').html('You have bought '+ data.amount + ' coins with this hash.');
		},
		error: function (data) {
			$('#error').html(data.responseJSON.error);
			$('#error').show();
		}

	});


}