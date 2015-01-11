function get_city(id1, id2) {
    $.ajax({
        data: "id1=" + id1 + "&id2=" + id2,
        type: "POST",
        dataType: "html",
        url: base_url_js + "index.php/user/get_citys",
        success: function (data) {
            $("#space_" + id2).html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("Error al Cargar los municipios")
        },
        async: true
    });
}

/**************************************/
var element = '';
/**************************************/
function get_cause() {
    //alert("ok1")
    element = '';
    $.ajax({
        data: "count=" + total_causes,
        type: "POST",
        dataType: "html",
        url: base_url_js + "index.php/result/get_causes",
        success: function (data) {
            element += '<div class="form-group" id="div_cau_' + eval(total_causes + 1) + '">';
            element += '<label class="control-label col-md-3">';
            element += 'Causal ' + eval(total_causes + 1);
            element += '</label>';
            element += '<div class="col-md-9">';
            element += data;
            element += '</div></div>';
            $("#causes").append(element);
            $("#total_causes").val(eval(total_causes + 1));
            total_causes++;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("Error al Cargar...");
        },
        async: false
    });
}

function delete_cause() {
    if (total_causes > 0) {
        $("#div_cau_" + total_causes).remove()
        total_causes--;
        $("#total_causes").val(total_causes);
    }
}


/**************************************/
function get_result() {
    //alert("ok1")
    element = '';
    $.ajax({
        data: "count=" + total_results,
        type: "POST",
        dataType: "html",
        url: base_url_js + "index.php/action/get_results",
        success: function (data) {
            element += '<div class="form-group" id="div_res_' + eval(total_results + 1) + '">';
            element += '<label class="control-label col-md-3">';
            element += 'Resultado ' + eval(total_results + 1);
            element += '</label>';
            element += '<div class="col-md-9">';
            element += data;
            element += '</div></div>';
            $("#results").append(element);
            $("#total_results").val(eval(total_results + 1));
            total_results++;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert("Error al Cargar...");
        },
        async: false
    });
}

function delete_result() {
    if (total_results > 0) {
        $("#div_res_" + total_results).remove()
        total_results--;
        $("#total_results").val(total_results);
    }
}


