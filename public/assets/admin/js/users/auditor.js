$("#sub_cons").click(function () {
    if($('#form_cons').parsley().validate()==true){
        console.log("hello checking");
        var dt = $('#form_cons').serialize();

        to_server(dt);
    }
});

function to_server(dt){
    var root_folder ="";
    var url  = root_folder+"/admin/auditor";
    $.ajax({
        url:url,
        type:'POST',
        data:dt,
        dataType:'json',
        success: function(data){
            console.log("Yes");
            window.location = "/admin/auditors";
        },
        error:function(data){
            console.log("Error");


        }
    });

}
