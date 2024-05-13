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

$("#client_log").on("click", function () {
    const scannedText = $("#scannedTextMemo").val();
    if (!scannedText) {
        $("#client_id_error").val("");
        $("#client_id_error").text("Please Scan or Input the Client ID");
        return;
    }
    $.ajax({
        url: "/client_log",
        type: "POST",
        data: {
            _token: csrfToken,
            client_id: scannedText,
        },
        success: function (data) {
            if (!data.status) {
                $("#client_id_error").text(data.message);
                return;
            }
            sessionStorage.setItem("displayToast", "true");
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
});


if (sessionStorage.getItem("displayToast") === "true") {
    displayToast();
    sessionStorage.removeItem("displayToast");
}
