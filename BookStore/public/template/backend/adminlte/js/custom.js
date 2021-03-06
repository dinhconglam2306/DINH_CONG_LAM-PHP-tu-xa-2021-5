function getUrlVar(key){
  var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search);
  return result && unescape(result[1]) || "";
}

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

    //Select Item => select group (Controller User)

    $('select[name="group_id"]').change(function (){
        $("#select-user").submit();
    });

    //Select item => select category (Controller Book)
    let book = $('.slb-select-category');

    // Select group -> select fillter
    $('select[name="select_group"]').change(function (){
        let url = $(this).attr('data-url').replace('value_new', $(this).val());
        window.location.href = url;
    });

    //Change group of item in Controller User
    $('select[name="change_group"]').change(function (e){
        let url  = $(this).attr('data-url');
        let selectValueACP =$(this).val();
        url = url.replace('value_new',selectValueACP);
        console.log(url)
        e.preventDefault();
        $(this).notify("Cập nhật thành công",{elementPosition: 'top',className: 'success',autoHideDelay:1000})
        $.get(url,function(data){
          console.log(data)
          let created = 'span.status-'+data[0];
          $(created).text(data[1]);
        },'json')

    });
    //Change Ordering of Category
    $('input[name="ordering"]').on('input', function(e){
      let url = $(this).attr('data-ordering');
      url = url.replace('value_new',$(this).val());
      $(this).notify("Cập nhật thành công",{elementPosition: 'top',className: 'success',autoHideDelay:1000})
      console.log(url)
      $.get(url,function(data){
        console.log(data)
        let modified = 'span.modified-by-'+data[0];
        let time = 'span.status-'+data[0];
        $(modified).text(data[2]);
        $(time).text(data[1]);
        console.log(time)
      },'json')
    });

    //submit
    
    $('select[name="category_id"]').change(function (){
      $('#select-book').submit();
    });
    $('select[name="special"]').change(function (){
      $('#select-book').submit();
    });
    $('select[name="is_home"]').change(function (){
      $('#select-ishome').submit();
    });
    
    //Active
    
    let controller = (getUrlVar('controller') == '') ? 'index' :getUrlVar('controller') ;
    let action = (getUrlVar('action') == '') ? 'index' :getUrlVar('action') ;
    $(`li.nav-item a[data-name=${controller}]`).addClass('active');
    $(`li.nav-item a[data-name=${controller}]`).parent().addClass('menu-is-opening menu-open');
    $(`li.nav-item a[data-name=${controller}]`).next().children().children(`a[data-action=${action}]`).addClass('active')
  

    //Img
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#blah').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
    };
  
  $("#imgInp").change(function(){
    $('div #picture img').remove();
    $('div #picture').append('<img id="blah" src="#" alt="your image" style="max-width:200px; margin-top:10px;" />')
      readURL(this);
  });

  


    //delete message after 2s
    // let message = $('#success-message');
    // setTimeout(function(){
    //     message.hide('slow', function(){ message.remove();});
    // },2000);
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
      };
    };

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
      };
    };
    function createToastFire(title,icon='warning'){
      return {
        icon: icon,
        title: title
      }
    };
    //RandomString
    function makePassword() {
      let length           = getRndInteger(8,13);
      let result           = '';
      let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let charactersLength = characters.length;
      for ( let i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
     }
     return result;
  };
    //Random Int(lenght)
    function getRndInteger(min, max) {
      return Math.floor(Math.random() * (max - min) ) + min;
    };
});
