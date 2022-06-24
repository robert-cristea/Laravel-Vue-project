$(document).ready(() => {
    var index =0;
    $("#addHightWayButton").click(e => {
        appendFun();
    });



    initRegisterHighWay = (para, type) => {
        var data = JSON.parse($("#register_variable").text());
        // console.log('sd')
        if(type == "high"){
            $("#region_register").html("");


            var exists = [];
            data.forEach(element => {
                if(element.highwayname == para){
                    if (exists.length==0)
                    {
                        exists.push(element.region);
                        // console.log(exists);
                    }else{
                        if(jQuery.inArray(element.region, exists) === -1){
                            exists.push(element.region);
                        }

                    }


                }
            });
            // var el;
            var el="<option selected value=''>Select Region Name</option>"
            exists.forEach(function (item) {
                el+= "<option value='" + item + "'>" + item + "</option>";

            })

            $("#region_register").append(el);

        }
        if(type == "region"){
            $("#highway_register").html("");
            var el="<option selected value=''>Select Highway Name</option>"

            data.forEach(element => {



                if(element.region == para){

                    // console.log(element);
                    el+= "<option value='" + element.routename + "'>" + element.routename + "</option>";


                }
            });
            $("#highway_register").append(el);
        }
        if(type == "code"){

            data.forEach(element => {
                    if(element.routename == para){


                        $('#code').val(element.code);
                        $('#abbreviation').val(element.abbreviation);
                        $("#from_register").val(element.from);
                        $("#to_register").val(element.to)
                    }
                });

        }


    };
    /**
     * Deleting Row
     */
    $('#highwayTable').on('click','.deleteBtn',function() {
        var id= $(this).data('id');
        $('#highwayTable').find('.row'+id).remove();

        if ($('.routes').length==0)
        {

            appendFun();
        }
        // console.log();

    });
    $("#concessionaire_register").change((e) => {

        initRegisterHighWay(e.target.value, "high");
    });
    $("#region_register").change((e) => {



        initRegisterHighWay(e.target.value, "region");
    });
    $("#highway_register").change((e) => {

        initRegisterHighWay(e.target.value, "code");
    });
    $('[data-toggle="tooltip"]').tooltip();
    
    
    function appendFun(){


            var el = "<tr index='" + index + "' class='routes row"+index+"'>";
            el += "<td>Highway Name</td>";
            el+= "<td>No/Code/Section</td>";
            el+= "<td>Abbreviation</td>";
            el += "<td>Chainage/Kilometer From</td>";
            el += "<td>To</td>";
            el += "</tr>";
            el += "<tr class='row"+index+"'>";
            el += "<td><input required type='text' name='route[]' class='form-control'></td>";
            el += "<td><input required type='text' name='code[]' class='form-control'></td>";
            el += "<td><input required type='text' name='abbreviation[]' class='form-control'></td>";
            el += "<td><input required type='text' name='from[]' class='form-control'></td>";
            el += "<td><input required type='text' name='to[]' class='form-control'></td>";
            if ($('.routes').length!=0)
            {
                el +="<td><button type='button' class='btn btn-danger deleteBtn' data-id='"+index+"'><i class='fa fa-remove'></i>x</button></td>";

            }
            el += "</tr>";
            $("#highwayTable").append(el);
            $("#highway_count").val(index);
            index = index+1;

    }
})