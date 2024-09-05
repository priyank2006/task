{{-- CDN Based --}}

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>




{{-- Local --}}

<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/jquery.slimscroll.min.js"></script>
<script src="/assets/plugins/morris/morris.min.js"></script>
<script src="/assets/plugins/raphael/raphael.min.js"></script>
<script src="/assets/js/chart.js"></script>
<script src="/assets/js/greedynav.js"></script>
<script src="/assets/js/layout.js"></script>
<script src="/assets/js/theme-settings.js"></script>
<script src="/assets/js/app.js"></script>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    function notyfSuccess(text) {
        return `
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
      <div class="toast-header">
        <strong class="me-auto">Success</strong>
        <small>Just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        ${text}
      </div>
    </div>`;
    }

    // Function to display the toast
    function showToast(text) {
        var toastContainer = document.getElementById('toastContainer'); // Container to hold the toast notifications
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toastContainer';
            toastContainer.classList.add('toast-container', 'position-fixed', 'top-0', 'end-0', 'p-3');
            document.body.appendChild(toastContainer);
        }

        var toastHTML = notyfSuccess(text);
        toastContainer.innerHTML += toastHTML;

        // Initialize and show the toast using Bootstrap's Toast component
        var toastElements = toastContainer.querySelectorAll('.toast');
        var lastToastElement = toastElements[toastElements.length - 1]; // Get the latest toast

        var toast = new bootstrap.Toast(lastToastElement);
        toast.show();
    }


    function notyfError(text) {
        var notyf = new Notyf();

        // Display an error notification
        notyf.error(text);
    }
</script>

<script>
    $(document).ready(function() {
        $(document).on("submit", ".del", function() {
            if (confirm("Are you sure ??")) {
                this.submit();
            } else {
                return false;
            }
        })
        $(document).ready(function() {
            $('.select2').select2();
        });
    });
</script>

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
<!-- jQuery and jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
