
//AJAX CHANGE GROUP ACP - User - SPECIAL in Backend
$('.cart-status').change(function(e){
  let statusValue = $(this).val();
  let url = $(this).attr('data-url').replace('value_new',statusValue);
  $(this).notify("Cập nhật thành công",{elementPosition: 'top',className: 'success',autoHideDelay:1000})
  e.preventDefault();
  $.get(url,function(data){

    let cartID  = '#'+ data[0];
    let classRemove1 = '';
    let classRemove2 = '';
    let classAdd = '';


    if(data[1] == 'delivery'){
      classRemove1 = 'delivery-danger';
      classRemove2 = 'delivery-success';
      classAdd = 'delivery-warning';
    }
    if(data[1] == 'not-delivery'){
      classRemove1 = 'delivery-warning';
      classRemove2 = 'delivery-success';
      classAdd = 'delivery-danger';
    }
    if(data[1] == 'delivered'){
      classRemove1 = 'delivery-danger';
      classRemove2 = 'delivery-warning';
      classAdd = 'delivery-success';
    }
    
    $(cartID).removeClass(classRemove1);
    $(cartID).removeClass(classRemove2);
    $(cartID).addClass(classAdd);
  },'json')
})

//Change category of book 
$('select[name="select_cart_status"]').change(function (){
  $('#formCart').submit();
  console.log(123);
});

