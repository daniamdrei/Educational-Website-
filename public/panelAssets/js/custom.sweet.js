
function customSweetAlert(type ,title , html , func) {
    var then_function = func || function () {
    };
    swal.fire({
        title: '<span class="'+type+'">'+title+'</span>',
        icon: type ,
        html : html ,
        confirmButtonText: window.ok ,
        confirmButtonColor: '#56ace0',
        // confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"

    }).then(then_function);
}

function errorCustomSweet() {
    customSweetAlert(
        'error',
        'Something went wrong!'
    );
}
function successCustomSweet(text) {
    customSweetAlert(
        'success',
        text
    );
}
