/**
 * execute part
 */
$(document).ready(function(){
	address.bindZipcodeFind();
});


var address = {
	bindZipcodeFind: function(){
		$('.zipcode-search').click(function(){
			$('.zipcode-search-result').text("로딩중...");
			$.get('zipsearch-action.php',{
				query: $('#dongName').val()
			},function(data){
				$('.zipcode-search-result').html(data);
				address.bindPutAddress();
			})
		});
	},
	bindPutAddress: function(){
		$('.zipcode-search-result a').click(function(){
			$('[name=zipcode1]').val($(this).parent().parent().find('.postcd1').text());
			$('[name=zipcode2]').val($(this).parent().parent().find('.postcd2').text());
			$('[name=OrdAddr]').val(address.remove_useless_addr($(this).parent().parent().find('.address').text()));
			address.hideZipcodeFinder();
			$('[name=addr]').focus();
			return false;
		});
	},
	remove_useless_addr: function(address){
		if(address.indexOf('~') != -1){
			address = address.split(' ').slice(0,-1).join(' ');
		}
		return address;
	},
	hideZipcodeFinder: function(){
		$('.zipcode-finder').slideUp();
	}
}
