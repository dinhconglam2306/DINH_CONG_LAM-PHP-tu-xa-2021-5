
//AJAX CHANGE GROUP ACP - User - SPECIAL in Backend
$('.cart-status').change(function(e){
  let statusValue = $(this).val();
  if(statusValue == 'default' || statusValue == 'cancelled'){
    $(this).notify("Không thay đổi được trạng thái đơn hàng này",{elementPosition: 'top',className: 'warning',autoHideDelay:1000})
  }else{
    let url = $(this).attr('data-url').replace('value_new',statusValue);
    $(this).notify("Cập nhật thành công",{elementPosition: 'top',className: 'success',autoHideDelay:1000})
    e.preventDefault();
    $.get(url,function(data){
      console.log(data);
      let cartID  = '#'+ data[0];
      let classRemove1 = '';
      let classRemove2 = '';
      let classRemove3 = '';
      let classRemove4 = '';
      let classRemove5 = '';
      let classAdd = '';
  
  
      if(data[1] == 'not-handle'){
        classRemove1 = 'processing-secondary';
        classRemove2 = 'delivery-warning';
        classRemove3 = 'delivery-info';
        classRemove4 = 'delivered-success';
        classRemove5 = 'cancelled-dark';
        classAdd = 'handle-danger';
      }
      if(data[1] == 'processing'){
        classRemove1 = 'handle-danger';
        classRemove2 = 'delivery-warning';
        classRemove3 = 'delivery-info';
        classRemove4 = 'delivered-success';
        classRemove5 = 'cancelled-dark';
        classAdd = 'processing-secondary';
      }
      if(data[1] == 'not-delivery'){
        classRemove1 = 'processing-secondary';
        classRemove2 = 'handle-danger';
        classRemove3 = 'delivery-info';
        classRemove4 = 'delivered-success';
        classRemove5 = 'cancelled-dark';
        classAdd = 'delivery-warning';
      }
      if(data[1] == 'delivery'){
        classRemove1 = 'processing-secondary';
        classRemove2 = 'delivery-warning';
        classRemove3 = 'handle-danger';
        classRemove4 = 'delivered-success';
        classRemove5 = 'cancelled-dark';
        classAdd = 'delivery-info';
      }
      if(data[1] == 'delivered'){
        classRemove1 = 'processing-secondary';
        classRemove2 = 'delivery-warning';
        classRemove3 = 'delivery-info';
        classRemove4 = 'handle-danger';
        classRemove5 = 'cancelled-dark';
        classAdd = 'delivered-success';
      }
      if(data[1] == 'cancelled'){
        classRemove1 = 'processing-secondary';
        classRemove2 = 'delivery-warning';
        classRemove3 = 'delivery-info';
        classRemove4 = 'handle-danger';
        classRemove5 = 'delivered-success';
        classAdd = 'cancelled-dark';
      }
  
      
      $(cartID).removeClass(classRemove1);
      $(cartID).removeClass(classRemove2);
      $(cartID).removeClass(classRemove3);
      $(cartID).removeClass(classRemove4);
      $(cartID).removeClass(classRemove5);
      $(cartID).addClass(classAdd);
    },'json')
  }
})

//Change category of book 
$('select[name="select_cart_status"]').change(function (){
  $('#formCart').submit();
  console.log(123);
});

