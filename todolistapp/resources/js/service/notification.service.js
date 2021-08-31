const NotificationService = {
    info(title = "Info", text = "This is info") {
        // this.$toastr('info', text, title)
        Toast.fire({
            icon: 'info',
            title: title,
        });
    },

    success(title = "Success", text = "This is info") {
        // this.$toastr('success', text, title)
        Toast.fire({
            icon: 'success',
            title: title,
        });
    },

    error(title = "Error", text = "This is info",) {
        // this.$toastr('error', text, title)
        Toast.fire({
            icon: 'error',
            title: title,
        });
    },

    task_add_warning(title = "Error", text = "This is info",) {
        // this.$toastr('error', text, title)
        Swal.fire({
            position: 'top',
            icon: 'warning',
            title: title,
            showConfirmButton: false,
            timer: 1500
        })
    },
}

export default NotificationService;
