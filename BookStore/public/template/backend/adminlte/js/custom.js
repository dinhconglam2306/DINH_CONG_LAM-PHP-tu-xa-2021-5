
$(document).ready(function () {

  //Delete Item
    let tableForm = $('#table-form');
    $('.btn-delete').click(function (e) {
        e.preventDefault();
        Swal.fire(createSwalFire('Xác nhận xóa!')).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('href');
            }
          })
    });

    //AJAX CHANGE GROUP ACP - STATUS
    $('.btn-change').click(function(e){
      let attrID = $(this).attr('id');
      let dataUrl = $(this).attr('data-url');
      $(this).attr('href',dataUrl);
      $(this).notify("Thay đổi status thành công", "success",{ position:"right" })
      e.preventDefault();
      $.get(dataUrl,function(data){
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
        $(elm).attr('data-url',data[2]);
        $(elm).removeClass(classRemove).addClass(classAdd);
        $(elm + ' i').removeClass(iconRemove).addClass(iconAdd);
      },'json')
    })
    
    //Change mutiAction (Status, Group ACP, delete)
    $('.btn-apply-bulk-action').click(function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let action = $('.slb-bulk-action').val();
        console.log(action)
        if (action) {
            let countChecked = $('input[name="cid[]"]:checked').length;
            if (countChecked) {
                url = url.replace('value_new', action);
                console.log(url);
                tableForm.attr('action', url);
                e.preventDefault();
                Swal.fire(createSwalFire('Xác nhận thực hiện action!')).then((result) => {
                    if (result.isConfirmed) {
                        tableForm.submit();
                    }
                  })
            } else {
                  const Toast = Swal.mixin(createSwalMixin())
                  Toast.fire(createToastFire('Vui lòng chọn ít nhất 1 dòng dữ liệu!'))
            }
        } else {
            const Toast = Swal.mixin(createSwalMixin())
            Toast.fire(createToastFire('Vui lòng chọn action thực hiện!'))
        }
    });

    //Check all check box
    $('#check-all-cid').change(function () {
        let checked = $(this).is(':checked');
        $('input[name="cid[]').prop('checked', checked);
    });

    $('.btn-generate').click(function () {
      let randomPw    = makePassword();
      $('input[name="form[password]"]').attr('value',randomPw);
      
    });

    //Select Item => select group

    $('select[name="select_group"]').change(function (){
        let url  = $(this).attr('data-url');
        let selectValueACP =$(this).val();
        url = url.replace('value_new',selectValueACP);
        window.location.href=url;
    })


    //Change group of item in Controller User
    $('select[name="change_group"]').change(function (e){
      let url  = $(this).attr('data-url');
      let selectValueACP =$(this).val();
      url = url.replace('value_new',selectValueACP);
      e.preventDefault();
      $(this).notify("Thay đổi group thành công","success",{ position:"top" })
      $.get(url,function(data){
      console.log(data)
      })

    })



    //delete message after 2s
    let message = $('#success-message');
    setTimeout(function(){
        message.hide('slow', function(){ message.remove(); });
    },2000);


    //Function



    function createSwalFire(title,icon='warning')
    {
      return  {
        title: title,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý'
      }
    }

    function createSwalMixin(){
      return {
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }
    }
    function createToastFire(title,icon='warning'){
      return {
        icon: icon,
        title: title
      }
    }
    //RandomString
    function makePassword() {
      let length           = getRndInteger(8,13);
      console.log(length);
      let result           = '';
      let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let charactersLength = characters.length;
      for ( let i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
     }
     return result;
  }
    //Random Int(lenght)
    function getRndInteger(min, max) {
      return Math.floor(Math.random() * (max - min) ) + min;
    }
});
