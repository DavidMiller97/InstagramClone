 $('document').ready(function(){

            function like(){

                $('.btn-like').unbind('click').click(function(){
                    
                    $(this).addClass('btn-dislike').removeClass('btn-like');
                   
                    $.ajax({
                            url: `http://127.0.0.1:8000/dislike/${$(this).data('imagen')}`,
                            method: "GET",
                
                    }).done(function (data) {

                            document.getElementById('number-likes').textContent = data.numeroLikes;

                    }).fail(function (error, responseText) {
                            console.log("Error. "+ error);

                    });
                    dislike();

                });
            }

            like();
           
            function dislike(){

                $('.btn-dislike').unbind('click').click(function(){
                    
                    $(this).addClass('btn-like').removeClass('btn-dislike');
                    $.ajax({
                            url: `http://127.0.0.1:8000/like/${$(this).data('imagen')}`,
                            method: "GET",
                
                    }).done(function (data) {

                            document.getElementById('number-likes').textContent = data.numeroLikes;

                    }).fail(function (error, responseText) {
                            console.log("Error. "+ error);

                    });
                    like();
                }); 
            }

            dislike();
            $('#buscador').submit(function(){

                console.log($('#buscador #name').val())
                $(this).attr('action', `http://127.0.0.1:8000/users/${$('#buscador #name').val()}`);
            });

            $('.like-imagen').each(function(){

                $(this).click(function(){

                        let imagen_id = $(this).attr('data-like-imagen');

                        $.ajax({
                                url: `http://127.0.0.1:8000/imagen/likes/${imagen_id}`,
                                method: "GET",
                    
                        }).done(function (result) {
                                
                                $('#user-likes').empty();
                                let {data} = result;

                                for(let i = 0; i < data.length; i++) {

                                        let {user_name, user_nickname, user_image, user_surname} = data[i];

                                        $("<div>", {
                                                'class': 'd-flex flex-row'
                                        })
                                        .append(
                                                $('<h4>', {
                                                        'html': user_name +  ' ' + user_surname + ' | ' + '@' + user_nickname,
                                                        'class': 'user-name w-100'
                                                })
                                        .append(
                                                  $('<hr>')
                                        )
                                        ).hide().appendTo('#user-likes').fadeIn('slow');
                                }
    
                        }).fail(function (error, responseText) {
                                console.log("Error. "+ error);
    
                        });
                });
            });

});