function addInput(namaInput) {
    var container = "#containerSolusi div:last";
    var lastField = $(container);
    var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
    var fieldWrapper = $("<div class=\"row\" id=\"widgetnama_penyakit" + intId + "\"/>");
    fieldWrapper.data("idx", intId);

    var containerWrapper1 = $("<div class=\"col-sm-11\"/>");
    var fName = $("<input type=\"text\" class=\"form-control mb-2\" name=\"solusi_penyakit[]\" />");
    containerWrapper1.append(fName);

    var containerWrapper2 = $("<div class=\"col-sm-1\"/>");
    var removeButton = $("<input type=\"button\" class=\"btn btn-danger\" value=\"-\" />");
    containerWrapper2.append(removeButton);

    removeButton.click(function() {
        fieldWrapper.remove();
    });

    fieldWrapper.append(containerWrapper1);
    fieldWrapper.append(containerWrapper2);
    $("#containerSolusi").append(fieldWrapper);
}
