$(document).ready(function () {
    let tableForm = $('#table-form');
    $('.btn-delete').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Xác nhận xóa',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('href');
            }
          })
    });

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
                Swal.fire({
                    title: 'Xác nhận thực hiện action!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        tableForm.submit();
                    }
                  })
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  Toast.fire({
                    icon: 'warning',
                    title: 'Vui lòng chọn ít nhất một dòng dữ liệu!'
                  })
            }
        } else {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: 'warning',
                title: 'Vui lòng chọn action thực hiện!'
              })
        }
    });

    $('#check-all-cid').change(function () {
        let checked = $(this).is(':checked');
        $('input[name="cid[]').prop('checked', checked);
    });

    //Select Item => select group ACP

    $('select[name="group-acp"]').change(function (){
        let url  = $(this).attr('data-url');
        let selectValueACP =$(this).val();
        if(selectValueACP == 'default') url = url.replace('&group_acp=value_new','');
        url = url.replace('value_new',selectValueACP);
        window.location.href=url;
    })

    //delete message
    let message = $('#success-message');
    setTimeout(function(){
        message.hide('slow', function(){ message.remove(); });
    },2000);
});
