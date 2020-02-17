// IziToast for Vue
export { Notice };


class Notice {
    constructor() {
        
    }

    info(message) {
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'info',
            title: 'Information!',
            text: message,
            showConfirmButton: false,
            timer: 7000
          })
    }

    warning(message) {
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Warning!',
            text: message,
            showConfirmButton: false,
            timer: 7000
          })
    }

    error(message) {
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'Error',
            title: 'Error!',
            text: message,
            showConfirmButton: false,
            timer: 7000
          })
    }

    success(message) {
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'success',
            title: 'Done!',
            text: message,
            showConfirmButton: false,
            timer: 7000
          })
    }
}