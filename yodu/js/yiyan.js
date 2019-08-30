 function hitokoto() {
      var  yiyanurl = yoduml+'/js/hitokoto/json.php';
        $.ajax({
            url: yiyanurl,
            type: 'get',
            beforeSend: function(xhr) {
                $('#hitokoto').html('一言加载中...');
            },
            success: function(data) {
                if (data.status == 'success') {
                    $('#hitokoto').html(data.result.hitokoto);
                } else {
                    $('#hitokoto').html('人生中总有很多失败，比如我现在就加载失败了');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                $('#hitokoto').html('公交司机终于在众人的指责中将座位让给了老太太');
            }
        });
    }
hitokoto();