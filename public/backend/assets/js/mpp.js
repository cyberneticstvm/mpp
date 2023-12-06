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

    $(document).on("click", ".radSlot", function () {
        if ($(this).is(":checked")) {
            $("#appointment_time").val($(this).val());
        }
    })
})