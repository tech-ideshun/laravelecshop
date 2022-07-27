$(function(){
  $("[name='image1']").on('change', function (e) {
    
    var reader = new FileReader();
    
    reader.onload = function (e) {
        $("#preview1").attr('src', e.target.result);
    }
 
    reader.readAsDataURL(e.target.files[0]);   
 
  });
});

$(function(){
  $("[name='image2']").on('change', function (e) {
    
    var reader = new FileReader();
    
    reader.onload = function (e) {
        $("#preview2").attr('src', e.target.result);
    }
 
    reader.readAsDataURL(e.target.files[0]);   
 
  });
});
$(function(){
  $("[name='image3']").on('change', function (e) {
    
    var reader = new FileReader();
    
    reader.onload = function (e) {
        $("#preview3").attr('src', e.target.result);
    }
 
    reader.readAsDataURL(e.target.files[0]);   
 
  });
});
$(function(){
  $("[name='image4']").on('change', function (e) {
    
    var reader = new FileReader();
    
    reader.onload = function (e) {
        $("#preview4").attr('src', e.target.result);
    }
 
    reader.readAsDataURL(e.target.files[0]);   
 
  });
});
