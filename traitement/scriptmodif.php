<script>
    $("#formmodiftemoignage").submit(function(event){
        event.preventDefault();

        let formData = {
            'temoignage' : $('#area').val(),
            'idtemoignage' : $('textarea[name=majtemoignage]').attr('data-idtemoignage'),
        };
        $.post( "./traitement/majtemoignage.php", formData, function(data) {
            $('#temoignagecontenu').html(data);
            $('#edition').html('<i id="editer" class="fas fa-edit" data-idtemoignage="'+$('textarea[name=majtemoignage]').attr('data-idtemoignage')+'"></i>');
        });
    });
    $('#voir').click(function () {
        $('#edition').html('<i id="editer" class="fas fa-edit" data-idtemoignage="'+$(this).attr('data-idtemoignage')+'"></i>');
        let formData={
            idtemoignage: $(this).attr('data-idtemoignage'),
        }
        //Récupérer témoignage
        $.post( "./traitement/contenutemoignageformate.php", formData, function(tem) {
            $('#temoignagecontenu').html(tem);
        });
        $.post( "./traitement/scriptmodif.php", '', function(dataa) {
            $('#script').html(dataa);
        });
    });

    $("#editer").click(function(event){
        event.preventDefault();
        $('#edition').html('<i id="voir" class="fas fa-eye" data-idtemoignage="'+$(this).attr('data-idtemoignage')+'"></i>');
        let idtemoignage=$(this).attr('data-idtemoignage');

        let formData = {
            'idtemoignage' : $(this).attr('data-idtemoignage'),
        };

        $.post( "./traitement/contenutemoignage.php", formData, function(data) {
            $('#temoignagecontenu').html(
                '<form id="formmodiftemoignage" method="POST">' +
                '<textarea id="area" name="majtemoignage" placeholder="Décrivez les faits dont vous avez été victime..." data-idtemoignage="'+ idtemoignage+'"></textarea>' +
                '<input class="bouton envoitemoignage" type="submit" value="Modifier le témoignage"></input>' +
                '</form>'
            );
            $('#area').val(data);
            var $jq=jQuery.noConflict();
            var wbbOpt = {
                buttons: "bold,italic,underline,justifyleft,justifycenter,justifyright,fontsize,quote",
                lang: "fr"
            }
            $jq(function(){
                $jq("#area").wysibb(wbbOpt);
            })
            $.post( "./traitement/scriptmodif.php", '', function(dataaa) {
                $('#script').html(dataaa);
            });
        });
    });
</script>