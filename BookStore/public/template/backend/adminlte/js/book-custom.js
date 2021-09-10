
//AJAX CHANGE GROUP ACP - User - SPECIAL in Backend
$('.btn-change').click(function(e){
  let attrID = $(this).attr('id');
  let dataUrl = $(this).attr('data-url');
  $(this).attr('href',dataUrl);
  $(this).notify("Cập nhật thành công",{elementPosition: 'top',className: 'success',autoHideDelay:1000})
  e.preventDefault();
  $.get(dataUrl,function(data){
    console.log(data)
      let elm       = 'a#'+ attrID;
      let classRemove = 'btn-success';
      let iconRemove  = 'fa-check';
      let classAdd = 'btn-danger';
      let iconAdd  = 'fa-minus';
    if(data[1] == 'active'){
      classRemove = 'btn-danger';
      iconRemove  = 'fa-minus';
      classAdd = 'btn-success';
      iconAdd  = 'fa-check';
    }
    if(data[1] == 1){
      classRemove = 'btn-danger';
      iconRemove  = 'fa-minus';
      classAdd = 'btn-success';
      iconAdd  = 'fa-check';
    }
    //Ajax modified_by
    let modified_by = '.modified-by-' + data[0];
    $(modified_by).text(data[4]);
  
    //Ajax Time
    let modified = 'span.status-'+data[0];
    $(modified).text(data[3]);
    $(elm).attr('data-url',data[2]);

    //Ajax icon Status 
    $(elm).removeClass(classRemove).addClass(classAdd);
    $(elm + ' i').removeClass(iconRemove).addClass(iconAdd);
  },'json')
})

//Change category of book 
$('select[name="change_category"]').change(function (e){
    let url  = $(this).attr('data-url').replace('value_new',$(this).val());
    e.preventDefault();
    $(this).notify("Cập nhật thành công",{elementPosition: 'top',className: 'success',autoHideDelay:1000})
    $.get(url,function(data){
      console.log(data)
      let modified = 'span.status-'+data[0];
      $(modified).text(data[1]);
    },'json')

});

