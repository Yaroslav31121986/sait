$(document).ready(function() {
            $('#butt').click(function() {
                // скрываем сообщение об ощибке
                $('#massegeShow').hide();

                // передаем переменной comment введеный коментарий пользователем
                var comment = $('#comment').val();

                // удаляем пробелы с комментариев 
                comment = $.trim(comment);
                var fail = "";

                // проверяем ввел ли пользователь комментарий или нет, если нет то выводим сообщение если да то продолжаем работу скрипта
                // если да то продолжаем работу скрипта
                if (comment.length < 1) {
                    fail = "Введите сообщение";
                } 
                if (fail != "") {
                    $('#massegeShow').html ("<div class='clear'>"+ fail + "<br></div>");
                    $('#massegeShow').show ();
                } else {
                    $.ajax({
                        url: 'comments/comments.php',
                        type: 'POST',
                        cache: false,
                        data: {
                            'comment': comment},
                        dataType: 'json',
                        success: function(data) {
                            //создаем дату комментария
                            var month=new Array(12);
                            month[0]="01";
                            month[1]="02";
                            month[2]="03";
                            month[3]="04";
                            month[4]="05";
                            month[5]="06";
                            month[6]="07";
                            month[7]="08";
                            month[8]="09";
                            month[9]="10";
                            month[10]="11";
                            month[11]="12";
                            var ago = new Date();
                            var y = ago.getFullYear();
                            var m = ago.getMonth();
                            var d = ago.getDate();

                            // Выыодим сам коментарий
                            $('#comments').append("<div class = 'comment'><h3>"+data.login+"</h3><p>"+comment+"</p><span>"+y+"-"+month[m]+"-"+d+"</span></div>");
                        }
                    });
                }
            });
        });