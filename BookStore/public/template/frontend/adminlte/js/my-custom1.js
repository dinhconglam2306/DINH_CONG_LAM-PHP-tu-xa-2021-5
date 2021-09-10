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
        e.preventDefault();
        $.get(url,function(data){
            let description = data[0]['description'];
            let name        = data[0]['name'];
            let picture     = data[0]['picture'];
            let price       =parseInt(data[0]['price']).toLocaleString();
            let sale_off    = data[0]['sale_off'];
            let price_sale  = (data[0]['price'] * (100 - sale_off)) / 100;
                price_sale  = parseInt(price_sale).toLocaleString();
            
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
            $('.book-price .price-sale').text(price_sale + 'đ')

          },'json')
    })
    let controller = (getUrlVar('controller') == '') ? 'index' :getUrlVar('controller') ;
    $(`li a[data-controller=${controller}]`).addClass('my-menu-link active');

});

