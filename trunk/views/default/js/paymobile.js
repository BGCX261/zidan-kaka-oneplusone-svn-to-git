$(function() {
    /*$("input[name='price']").click(function() {
        setPrice();
    });
    $("input[name='type']").click(function() {
        var v, s;
            v = $("input[name='price_slow']:checked").val();
            s = $("input[name='price'][value='" + v + "']") || $("input[name='price']")[0];
        if (s) {
            s.checked = "checked";
            setPrice();
        }
    });
   */
    $("input[name='phone_number']").keyup(function(){
        var mobile=$(this).val();
        $('#view_num').html(mobile);
        $('#view_num_info').html('');
        
        if(mobile.length==11&&isMobile(mobile))
        {
            $.ajax({
                   type: "POST",
                   url:"http://www.fakami.com/default.aspx",
                   data: "mobile="+mobile,
                   success: function(msg){
                     if(msg!=null)
                     {
                        $('#view_num_info').html(msg);                        
                     }
                   }
                });
        }
    }); 
     
    $("input[name='type']")[0].click();
});

function isMobile(mobile)
{
    var myreg = /^(((13[0-9]{1})|159|153|158|186|187|188|189)+\d{8})$/;
    return myreg.test(mobile);
}
 function setPrice()
    {
        var value;        
        value=$("#rd_fv option:selected").val();
        $('#payvalue').html(value); 
        var facePrice=$("#rd_fv option:selected").attr("data-price");
        $("input[name='upstream']").attr('value',facePrice);
            alert(value+'AAA'+facePrice);  
    }
  

 
 function isValid()
 {
    var mobile=$("input[name='phone_number']").val();
    var result= isMobile(mobile);
    if(!result)
    {
        $("input[name='phone_number']").addClass("num-input error");
        return result;
    }
    return result;
 }