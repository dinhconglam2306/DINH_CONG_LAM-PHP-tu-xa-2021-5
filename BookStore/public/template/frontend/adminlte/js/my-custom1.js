function getUrlVar(key){
    var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search);
    return result && unescape(result[1]) || "";
}  
$(document).ready(function () {
    $('.category-show').click(function (e){
        let url  = $(this).attr('data-url').replace('value_new',$(this).attr('data-id'));
        e.preventDefault();
        $.get(url,function(data){
            console.log(data);
            let categoryName        = data[0]['name'];
            let categoryPicture     = data[0]['picture'];

            let picturePath = $('.quick-view-img img').attr('src');
            arrPicturePath  = picturePath.split('/');
            replaceName     = arrPicturePath[arrPicturePath.length - 1];
            picturePath = picturePath.replace(replaceName,categoryPicture);
             //Book name
             $('.book-name').text(categoryName);

            let bookInCategory = data[0]['books'];
            let xhtmlListBook ='<ul class="box-list">';
            $.each(bookInCategory,function(index,value){
                // xhtmlListBook += `<li title="${value['name']}" style="display:block; font-size:18px; margin-top:4px; cursor:pointer;"><a href="index.php?module=frontend&controller=book&action=detail&book_id=${value['id']}"></a>${value['name']}</li>`;
                xhtmlListBook += `<li title='${value['name']}' style='display:block; font-size:18px; margin-top:8px; cursor:pointer;'><a href='index.php?module=frontend&controller=book&action=detail&book_id=${value['id']}'>${value['name']}</li>`;
            })
            xhtmlListBook +='</ul>';

            $('.book-description .description').html(xhtmlListBook);
            // console.log(xhtmlListBook)


        },'json')
    })
    //Quick view book
    $('.ti-search').click(function (e){
        let url  = $(this).attr('data-url').replace('value_new',$(this).attr('data-id'));
        console.log(url)
        e.preventDefault();
        $.get(url,function(data){
            console.log(data);
            let description = data[0]['description'];
            let name        = data[0]['name'];
            let picture     = data[0]['picture'];
            let price       =parseInt(data[0]['price']).toLocaleString();
            let sale_off    = data[0]['sale_off'];
            let price_sale  = (data[0]['price'] * (100 - sale_off)) / 100;
            
            //Book image
            let picturePath = $('.quick-view-img img').attr('src');
            arrPicturePath  = picturePath.split('/');
            replaceName     = arrPicturePath[arrPicturePath.length - 1];
            picturePath = picturePath.replace(replaceName,picture);

            $('.quick-view-img img').attr('src',picturePath);
            //Book description
            $('.book-description .description').text(description);
            
            //Book name
            $('.book-name').text(name);

            //Book price
            $('.book-price .price').text(price + 'đ')
            $('.book-price .price-sale').text(parseInt(price_sale).toLocaleString() + 'đ')
            // add Attr
            let link = `index.php?module=frontend&controller=user&action=order&book_id=${data[0]['id']}&price=${price_sale}&quantity=value_new`;
            $('.btn-add-to-cart').attr('data-url',link);

            //add href box show detail
            let hrefDetail = `index.php?module=frontend&controller=book&action=detail&book_id=${data[0]['id']}`;
            $('.btn-view-book-detail').attr('href',hrefDetail);

          },'json')
    })

    $('.ti-shopping-cart').click(function (e){
        let url = $(this).attr('data-url');
        console.log(url);
        $('a#cart').notify("Đã thêm vào rỏ hàng",{elementPosition: 'top',className: 'success',autoHideDelay:1000})
        e.preventDefault();
        $.get(url,function(data){
            console.log(data)
            $('.badge-items').text(data)
        },'json')
    })
    $('.btn-add-to-cart').click(function (e){
        let quantityValue = $('input[name="quantity"]').val();
        let url  = $(this).attr('data-url').replace('value_new',quantityValue);
        e.preventDefault();
        $('.product-title').notify("Đã thêm vào rỏ hàng",{elementPosition: 'top',className: 'success',autoHideDelay:1200})
        $.get(url,function(data){
            console.log(data)
        })
        setTimeout(function(){
            location.reload();
        },1400);
    })

    $('.btn-add-to-cart-detail').click(function (e){
        let quantityValue = $('input[name="quantity"]').val();
        let url  = $(this).attr('data-url').replace('value_new',quantityValue);
        e.preventDefault();
        $.get(url,function(data){
            console.log(data)
            $('.badge-items').text(data);
            $('input[name="quantity"]').val('1');
        })
    })


    // Active Controler User in Frontend

    let controllerUser  = (getUrlVar('controller') == '') ? 'index' :getUrlVar('controller') ;
    let actionUser      = (getUrlVar('action') == '') ? 'index' :getUrlVar('action') ;

    let dataUser  = `${controllerUser}-${actionUser}`;
    $(`a[data=${dataUser}]`).parent().addClass('active');


    //changeQuantity in Cart

    $('input[name="quantity-cart"]').change(function (e){
        let quantity = $(this).val();
        let url      = $(this).attr('data-quantity').replace('value_new',quantity);
        console.log(url)
        window.location.href = url;
    })

    $('.ti-close').click(function (){
        let url = $(this).attr('data-delete');
        console.log(url);
        window.location.href = url;
    })


    $('.check-eye').hover(function (){
        let type = ($(this).prev().attr('type') == 'text') ? 'password' : 'text';
        $(this).prev().attr('type',type);
    })
});

