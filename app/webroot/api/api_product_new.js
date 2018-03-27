/**
 * Created by nhdang on 1/31/2018.
 */
$(function(){
    jQuery.support.cors = true;
    $.ajax({
        url: 'http://nhadat.vn/products/api_get_products',
        type: 'POST',
        dataType: 'JSON',
        data: {
            serect_key: 'nhadatphong.com',
            site_key: 'api_ndp001'
        },
        beforeSend: function()
        {
            $('#api-get-ndp-new').html('<div class="text-center" style="margin-top: 20px"><i class="fa fa-spin fa-spinner text-center" style="color: #d5d5d5; font-size: 3em"></i><br>Đang tải</div>');
        },
        success: function(data)
        {
            $('#api-get-ndp-new').html('');
            var sum = data.length;
            if(sum > 0)
            {
                $('#api-get-ndp-new').html('<h3>Tin bất động sản</h3>');
                var i = 0;
                for(i; i < sum; i++)
                {
                    var html = '<div class="item">';
                    html = html + '<div class="col-xs-12"><h4><a target="_blank" href="' + data[i].productlink + '">' + data[i].title +'</a></h4></div>';
                    html = html + '<div class="col-xs-4"><a target="_blank" href="' + data[i].productlink + '"><div class="bg" style="background: url(' + data[i].image + ')"></div></a></div>';
                    html = html + '<div class="col-xs-8">' +
                        '<div class="text-center bolder bigger-120">' + data[i].price + '</div> ' +
                        '<div class="text-center bolder bigger-120">' + data[i].price + '</div> ' +
                        '<div class="">' + data[i].address + '</div> ' +
                        '</div>';
                    html = html + '</div>';
                    $('#api-get-ndp-new').append(html);
                }
            }
        }
    })
});
