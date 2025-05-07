// jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Bootstrap
import 'bootstrap';

// DataTables
import 'datatables.net-bs5';

// SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// Initialisation
$(document).ready(function() {
    $('.datatable').DataTable();
});

import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import './reservation';

