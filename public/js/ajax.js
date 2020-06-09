
$(function(){
    $("#formImportCsv").on("submit", function(e) {
        e.preventDefault();
        var f = $(this);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData(document.getElementById("formImportCsv"));
        formData.append("dato", "valor");
        formData.append(f.attr("name"), $(this).files);
        
        $.ajax({
            headers: {
                'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/importCsv",
            type: "post",
            dataType: "html",
            data: {
                formData: formData,
                _token : CSRF_TOKEN
            },
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            $("#mensaje").html(res);
        });
    });
 });    