</div>
</div>
<script src="<?php echo ROOT_VIEWS; ?>js/jquery-3.4.1.min.js"></script>
<script src="<?php echo ROOT_VIEWS; ?>js/bootstrap.bundle.js"></script>
<script src="<?php echo ROOT_VIEWS; ?>js/bootstrap.js"></script>
<script>
    $(document).ready(function(){

        $("#myformupload").change(function(e){
            e.preventDefault();
            var valform = $('#myformupload').get(0);
            var form_data = new FormData(valform);
            $.ajax({
                type: "POST",
                url:"?page=uploadcontroller",
                contentType: false,
                processData:false,
                data : form_data,
                // cache: false,
                timeout:3000,
                success: function(response, data) {
                    if(data === 'success') {
                        $('div#filescontainer').load(document.URL + ' #myfiles');
                    }
                },
                error: function(err){
                    console.log('ERREUR');
                    console.log(err);
                }
            });
        });
    });

    function uploadFiles() {
        $.ajax({
            type:"GET",
            url:"?page=uploadcontroller",
            dataType: 'JSON',
            success: function (result){
                $('div#filescontainer').load(document.URL + ' #myfiles');
                console.log(result);
            },
            error: function(err){
                console.log('ERREUR');
                console.log(err);
            }
        })
    }

    function searchFile() {
        var fieldval = document.getElementById('fieldsearch').value;
        var jsonManifest = 'views/manifest/manifest.json';

        $.ajax({
            type: "POST",
            url: jsonManifest,
            dataType: 'JSON',
            success: function (data) {
                // console.log(data);
                if(fieldval.length >= 3){
                    $.each(data, function (i, v) {
                        const pattern = new RegExp(fieldval);
                        if (v.filename.search(pattern) !== -1) {

                            var exemplemodal = "#exampleModal" + v.id;
                            var exemplemodaltargeted = "exampleModal" + v.id;
                            var examplemodallabel= "exampleModalLabel" + v.id;
                            var jsfilename = v.filename;
                            var fileroot = "<?php echo FILESREADY; ?>"+'/'+ v.file;

                            var container = '<div class="list-group">' +
                                            '<button type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="'+ exemplemodal +'">'+ jsfilename +'</button>'+
                                                '<div class="modal fade" id="'+exemplemodaltargeted+'" tabindex="\-1\" role="dialog" aria-labelledby="'+ examplemodallabel +'" aria-hidden="true">'+
                                                    '<div class="modal-dialog" role="document">'+
                                                        '<div class="modal-content">'+
                                                            '<div class="modal-header">'+
                                                                '<h5 class="modal-title" id="'+examplemodallabel+'">'+ jsfilename +'</h5>'+
                                                                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                                '<span aria-hidden="true">&times;</span>'+
                                                                '</button>'+
                                                            '</div>'+
                                                            '<div class="modal-body">'+
                                                                '<embed src="'+ fileroot +'" frameborder="0" width="100%" height="400px">'+
                                                            '</div>'+
                                                            '<div class="modal-footer">'+
                                                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>';


                            $( "div#myfiles" ).replaceWith(container);
                            console.log(v.file);
                            console.log(v.id);
                        }
                    });
                }else if(fieldval.length === 0) {
                    $('div#filescontainer').load(document.URL + ' #myfiles');
                }
            },
            error: function(error) {
                console.log(error);
                console.log('erreur impossible de charger le manifest');
            }
        });
    }
</script>
</body>
</html>
<?php
