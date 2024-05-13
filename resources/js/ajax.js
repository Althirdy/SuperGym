import "flowbite";

$("#form").on("submit", function () {
    event.preventDefault();
});
$("#daily_btn").on("click", function () {
    DailyPost();
});

let category_id;

$(".radio").each(function () {
    $(this).on("click", function () {
        var value = $(this).data("value");
        if (value == 1) {
            var id = $(this).attr("id");
            category_id = 1;
            $("#" + value).prop("checked", true);
        } else if (value == 2) {
            category_id = 2;
            $("#" + value).prop("checked", true);
        }
    });
});
const csrfToken = $('meta[name="csrf-token"]').attr("content");

const toast = `<div id="toast-simple" class="toast flex fixed right-5 bottom-5 items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
<div class="ps-4 text-sm font-normal">Client Added successfully.</div>
</div>`;

const displayToast = () => {
    $("body").append(toast);
    setTimeout(function () {
        $(".toast").fadeOut("ease", function () {
            $(this).remove();
        });
    }, 3000);
};

const DailyPost = () => {
    // Get the CSRF token from the meta tag in your HTML

    // Your AJAX request
    $.ajax({
        url: "/DailyPost",
        type: "POST",
        data: {
            name: $("#name").val(),
            category_id: category_id,
            _token: csrfToken, // Include the CSRF token
        },
        success: function (res) {
            console.log(res);
            // Set flag in session storage
            sessionStorage.setItem("displayToast", "true");
            // Reload the page
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
};

// Check for displayToast flag in session storage
if (sessionStorage.getItem("displayToast") === "true") {
    displayToast();
    // Remove the flag to prevent displaying toast on subsequent page reloads
    sessionStorage.removeItem("displayToast");
}

//Members Form

$("#goal").change(function () {
    var categoryId = $(this).val();
    $.ajax({
        url: "/coaches/" + categoryId,
        type: "GET",
        success: function (data) {
            $("#coach").empty();
            $("#coach").append(` <option value="0">No Coach</option>`);
            data.forEach(function (data) {
                $("#coach").append(`
                <option value="${data.id}">${data.name} (${data.contact_no})</option>
                   `);
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
});

//Member Registration

$("#add_client").on("click", function () {
    const client_name = $("#client_name").val();
    const client_email = $("#client_email").val();
    const goal = $("#goal").val();
    const subs = $("#subs").val();
    const coach = $("#coach").val();
    const weight = $("#weight").val();
    $.ajax({
        url: "/add_client",
        type: "POST",
        data: {
            email: client_email,
            name: client_name,
            coach_id: coach,
            goal_id: goal,
            subs_id: subs,
            weight: weight,
            _token: csrfToken,
        },
        success: function (data) {
            // console.log(data);
            if (data.isInserted) {
                sessionStorage.setItem("displayToast", "true");
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            $(".validation-error").text("");

            var errors = xhr.responseJSON.errors;
            if (errors) {
                // Display validation errors
                $.each(errors, function (key, value) {
                    $("#" + key + "_error").text(value);
                });
            }
        },
    });
});

$("#add_coach").on("click", function () {
    const name = $("#coach_name").val();
    const email = $("#coach_email").val();
    const goal = $("#goal").val();
    const contact_no = $("#contact_no").val();
    $.ajax({
        url: "/add_coach",
        type: "POST",
        data: {
            name: name,
            email: email,
            goal: goal,
            contact_no: contact_no,
            _token: csrfToken,
        },
        success: function (data) {
            $(".validation-error").text("");
            if (data.isInserted) {
                sessionStorage.setItem("displayToast", "true");
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            $(".validation-error").text("");

            var errors = xhr.responseJSON.errors;
            if (errors) {
                // Display validation errors
                $.each(errors, function (key, value) {
                    $("#" + key + "_error").text(value);
                });
            }
        },
    });
});
