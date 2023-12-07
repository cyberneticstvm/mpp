$(function () {
    "use strict"
    $("#profileSelector").modal('show');

    $(".show_available_slots").click(function () {
        var adate = $("#appointment_date").val();
        if (adate) {
            $.ajax({
                type: 'POST',
                url: '/get/appointments',
                data: { 'appointment_date': adate },
                dataType: 'JSON',
                success: function (res) {
                    $("#appointmentDrawer").drawer('toggle');
                    let output = `<div class='container'><div class='row'>`;
                    output += `<h3 class="mb-3 mt-3">Available Slots</h3>`;
                    $.each(JSON.parse(res.appointments), function (key, value) {
                        let cls = (value.disabled) ? `<p class="text-danger">Booked</p>` : `<div class="radio radio-primary"><input id="${value.time}" type="radio" name="radio1" value="${value.time}" class="radSlot"><label for="${value.time}"></label></div>`;
                        output += `<div class="card col-3 m-auto"><div class="top-dealerbox text-center"><h6 class="mt-3">${value.time}</h6>${cls}</div></div>`
                    });
                    output += `<div class="text-end"><button class="btn btn-danger" data-toggle="drawer" data-target="#appointmentDrawer">Cancel</button></div></div></div>`;
                    $("#appointmentDrawer").find(".drawer-content").html(output);
                },
                error: function (err) {
                    failed(err)
                }
            });
        } else {
            failed({
                'error': 'Please select Appointment Date!'
            })
            return false;
        }
    });

    $(".addSymptom").click(function () {
        $("#symptomDrawer").drawer('toggle');
    });

    $(document).on("submit", ".frmSymptom", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/symptom/add',
            data: { 'name': $("#symptomName").val() },
            dataType: 'JSON',
            success: function (res) {
                success(res)
                bindDDLbyId('selSymptom', res)
                $(".frmSymptom")[0].reset();
                $("#symptomDrawer").drawer('toggle');
            },
            error: function (err) {
                error(err)
            }
        })
    });

    $(".addDiagnosis").click(function () {
        $("#diagnosisDrawer").drawer('toggle');
    });

    $(document).on("submit", ".frmDiagnosis", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/diagnosis/add',
            data: { 'name': $("#diagnosisName").val() },
            dataType: 'JSON',
            success: function (res) {
                success(res)
                bindDDLbyId('selDiagnosis', res)
                $(".frmDiagnosis")[0].reset();
                $("#diagnosisDrawer").drawer('toggle');
            },
            error: function (err) {
                error(err)
            }
        })
    });

    $(".addMedicine").click(function () {
        $("#medicineDrawer").drawer('toggle');
    });

    $(document).on("submit", ".frmMedicine", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/medicine/add',
            data: { 'name': $("#medicineName").val() },
            dataType: 'JSON',
            success: function (res) {
                success(res)
                bindDDLbyClass('selMedicine', res)
                $(".frmMedicine")[0].reset();
                $("#medicineDrawer").drawer('toggle');
            },
            error: function (err) {
                error(err)
            }
        });
    });

    $(document).on("click", ".radSlot", function () {
        if ($(this).is(":checked")) {
            $("#appointment_time").val($(this).val());
        }
    });

    $(".select2").select2({
        placeholder: 'Select'
    });

    $(".medRow").click(function () {
        $.ajax({
            type: 'GET',
            url: '/medicine/row/add',
            dataType: 'JSON',
            success: function (res) {
                $(".medTable").append(`<tr><td><select name="medicines[]" class="form-control selMedicine"><option value=""></option></select></td><td><input type="number" name="qty[]" min="1" max="" step="1" class="form-control" placeholder="Qty"></td><td><input type="text" name="dosage[]" class="form-control" placeholder="Dosage"></td><td><input type="text" name="duration[]" class="form-control" placeholder="Duration"></td><td><input type="text" name="notes[]" class="form-control" placeholder="Notes"></td><td><a href="javascript:void(0)" onClick="$(this).parent().parent().remove();"><i class="icofont icofont-ui-delete text-danger"></i></a></td></tr>`);
                bindDDL('selMedicine', res)
            }
        })

    })
});

function bindDDLbyId(sel, res) {
    var newOption = new Option(res.data.name, res.data.name, true, true);
    $('#' + sel).append(newOption).trigger('change');
}
function bindDDLbyClass(sel, res) {
    var newOption = new Option(res.data.name, res.data.name, true, true);
    $('.' + sel).last().append(newOption).trigger('change');
}

function bindDDL(sel, res) {
    var xdata = $.map(res.data, function (obj) {
        obj.text = obj.name || obj.id;
        return obj;
    });
    //$('.selPdct').last().select2().empty();                      
    $('.' + sel).last().select2({
        placeholder: 'Select',
        data: xdata
    });
}
