$(function(){
   /* $('select').change(function(){
        sendRequest();
    })
*/
    function sendRequest(){
        $('form').ajaxSubmit({
            success:function(data){
                $('.imoveis .container').html(data);
            }
        })
    }
    //outra opção
    setInterval(function(){
        sendRequest();
    },3000)
})