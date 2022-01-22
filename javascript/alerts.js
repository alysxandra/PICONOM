function emailTaken() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Email has been used!'
    })
};

function emailInvalid() {
    Swal.fire({
        icon: 'warning',
        text: 'Invalid email format!'
    })
};

function userLength() {
    Swal.fire({
        icon: 'warning',
        text: 'Your username must be between 2 to 25 characters!'
    })
};

function userTaken() {
    Swal.fire({
        icon: 'error',
        title: 'Oh no...',
        text: 'That username is taken :('
    })
};

function passwordsUnmatched() {
    Swal.fire({
        icon: 'error',
        text: 'Your passwords do not match!'
    })
};

function passwordsNotEnglish() {
    Swal.fire({
        icon: 'error',
        title: 'Sorry..',
        text: 'Your password can only contain english characters and numbers....'
    })
};

function passwordsLength() {
    Swal.fire({
        icon: 'warning',
        text: 'Your password must be between 3 to 30 characters!'
    })
};

function creationSuccess() {
    Swal.fire({
        icon: 'success',
        title: 'All set!',
        text: 'Your account is created successfully! Please proceed to login :D'
    })
};

function loginFail() {
    Swal.fire({
        icon: 'error',
        title: 'Oh no :(',
        text: 'Your credentials do not match! Please try again!'
    })
};

function uploadFail() {
    Swal.fire({
        icon: 'error',
        title: 'Oh no :(',
        text: 'Your files could not be uploaded!'
    })
};

function fileTypeFail() {
    Swal.fire({
        icon: 'warning',
        text: 'only jpeg, jpg and png files are allowed :('
    })
};

function confirmDelete() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}