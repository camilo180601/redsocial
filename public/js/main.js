var url = "http://redsocial.com.devel";
window.addEventListener("load", function(){
    $('.btn-like').css('cursor', 'pointer')
    $('.btn-dislike').css('cursor', 'pointer')
 
    // Boton de like 
    function like(){
        $('.btn-like').off('click').on("click", function() {
            console.log('like');
            $(this).addClass('btn-dislike').remove('btn-like');
            $(this).attr('src', '/img/hearts-red.png');
 
            
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado like a la publicacion');
                    }else{
                        console.log('Error al dar like');
                    }
                }
            });
 
 
            dislike();
        });
    }
    like();
 
    // Boton de dislike
    function dislike(){
        $('.btn-dislike').off('click').on("click", function() {
            console.log('dislike');
            $(this).addClass('btn-like').remove('btn-dislike');
            $(this).attr('src', '/img/hearts-black.png');
 
            
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado dislike a la publicacion');
                    }else{
                        console.log('Error al dar dislike');
                    }
                }
            });
 
            like();
        });
    }
    dislike();

    //Buscador
    $('#buscador').submit(function(e){
		$(this).attr('action',url+'/people/'+$('#buscador #search').val());
	});
})